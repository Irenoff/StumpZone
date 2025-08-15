<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    /**
     * List orders (tries to scope to the vendor if possible).
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 15);

        $q = DB::table('orders');

        // Try to scope to the logged-in vendor if schema allows
        if (Schema::hasColumn('orders', 'vendor_id')) {
            $q->where('orders.vendor_id', Auth::id());
        } elseif (
            Schema::hasTable('order_items') &&
            Schema::hasTable('products') &&
            Schema::hasColumn('order_items', 'order_id') &&
            Schema::hasColumn('order_items', 'product_id') &&
            Schema::hasColumn('products', 'id') &&
            Schema::hasColumn('products', 'vendor_id')
        ) {
            // Orders that have at least one item owned by this vendor
            $q->whereExists(function ($sub) {
                $sub->select(DB::raw(1))
                    ->from('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->whereColumn('order_items.order_id', 'orders.id')
                    ->where('products.vendor_id', Auth::id());
            });
        }

        $orders = $q->select('orders.*')
            ->orderByDesc('orders.created_at')
            ->paginate($perPage);

        return view('vendor_panel.orders.index', compact('orders'));
    }

    /**
     * Show a single order with its items if available.
     */
    public function show($orderId)
    {
        $order = DB::table('orders')->where('id', $orderId)->first();
        if (!$order) abort(404);

        $items = collect();
        if (Schema::hasTable('order_items')) {
            $itemsQ = DB::table('order_items')->where('order_id', $orderId);

            // Try to bring product name if we can
            if (Schema::hasTable('products') && Schema::hasColumn('order_items', 'product_id')) {
                $itemsQ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
                       ->addSelect('products.name as product_name', 'products.title as product_title');
            }

            $items = $itemsQ->addSelect('order_items.*')->get();
        }

        return view('vendor_panel.orders.show', compact('order', 'items'));
    }

    /**
     * Confirm an order:
     * - sets orders.status = 'confirmed'
     * - creates/updates a deliveries row with customer + items + grand_total
     */
    public function confirm($orderId)
{
    // sanity checks
    if (!Schema::hasTable('orders')) {
        return back()->with('error', 'orders table missing.');
    }
    if (!Schema::hasTable('deliveries')) {
        return back()->with('error', 'deliveries table does not exist. Run the migration.');
    }

    $order = DB::table('orders')->where('id', $orderId)->first();
    if (!$order) {
        return back()->with('error', 'Order not found.');
    }

    // Optional vendor scope checks
    if (Schema::hasColumn('orders', 'vendor_id')) {
        if ((int) ($order->vendor_id ?? 0) !== (int) Auth::id()) {
            abort(403, 'You do not have permission to confirm this order.');
        }
    } elseif (
        Schema::hasTable('order_items') &&
        Schema::hasTable('products') &&
        Schema::hasColumn('order_items', 'order_id') &&
        Schema::hasColumn('order_items', 'product_id') &&
        Schema::hasColumn('products', 'id') &&
        Schema::hasColumn('products', 'vendor_id')
    ) {
        $owned = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $order->id)
            ->where('products.vendor_id', Auth::id())
            ->exists();

        if (!$owned) abort(403, 'You do not have permission to confirm this order.');
    }

    // Build items payload
    $itemsPayload = [];
    $itemsTotal   = 0.0;

    if (Schema::hasTable('order_items')) {
        $rows = DB::table('order_items')->where('order_id', $order->id)->get();
        foreach ($rows as $r) {
            $qty   = (int) ($r->quantity ?? 0);
            $price = (float) ($r->unit_price ?? $r->price ?? 0);
            $line  = $qty * $price;
            $itemsTotal += $line;

            $name = $r->name ?? $r->product_name ?? ('Item #'.($r->item_id ?? $r->product_id ?? ''));

            $itemsPayload[] = [
                'item_id'    => $r->item_id ?? $r->product_id ?? null,
                'name'       => $name,
                'quantity'   => $qty,
                'price'      => $price,
                'line_total' => $line,
                'sport_type' => $r->sport_type ?? null,
            ];
        }
    } else {
        // legacy single-line fallback
        $qty   = (int) ($order->quantity ?? 0);
        $price = (float) ($order->price ?? 0);
        $line  = $qty * $price;
        $itemsTotal = (float) ($order->items_total ?? $order->total ?? $line);

        $itemsPayload[] = [
            'item_id'    => $order->equipment_id ?? null,
            'name'       => $order->equipment_name ?? 'Item',
            'quantity'   => $qty,
            'price'      => $price,
            'line_total' => $line,
            'sport_type' => $order->sport_type ?? null,
        ];
    }

    $deliveryFee   = (float) ($order->delivery_fee ?? 0);
    $deliveryTotal = (float) ($order->grand_total ?? ($itemsTotal + $deliveryFee));

    // Update order status first (if column exists)
    if (Schema::hasColumn('orders', 'status')) {
        DB::table('orders')->where('id', $order->id)->update([
            'status'     => 'confirmed',
            'updated_at' => now(),
        ]);
    }

    // Build deliveries payload ONLY with columns that exist
    $deliveriesCols = collect(DB::getSchemaBuilder()->getColumnListing('deliveries'))
                        ->map(fn($c) => strtolower($c))
                        ->flip(); // for fast isset

    $payload = [
        'updated_at' => now(),
    ];

    // always include order_id (exists by design)
    if (isset($deliveriesCols['order_id'])) {
        $payload['order_id'] = $order->id;
    }

    // conditionally include optional fields
    if (isset($deliveriesCols['order_number']) && Schema::hasColumn('orders', 'order_number')) {
        $payload['order_number'] = $order->order_number;
    }
    if (isset($deliveriesCols['customer_name'])) {
        $customerName = null;
        if (Schema::hasTable('users') && Schema::hasColumn('orders', 'user_id') && $order->user_id) {
            $u = DB::table('users')->where('id', $order->user_id)->select('name')->first();
            $customerName = $u->name ?? null;
        }
        if (!$customerName && Schema::hasColumn('orders', 'customer_name')) {
            $customerName = $order->customer_name ?? null;
        }
        $payload['customer_name'] = $customerName;
    }
    if (isset($deliveriesCols['customer_email']) && Schema::hasColumn('orders','customer_email')) {
        $payload['customer_email'] = $order->customer_email;
    }
    if (isset($deliveriesCols['customer_address']) && Schema::hasColumn('orders','customer_address')) {
        $payload['customer_address'] = $order->customer_address;
    }
    if (isset($deliveriesCols['delivery_method']) && Schema::hasColumn('orders','delivery_method')) {
        $payload['delivery_method'] = $order->delivery_method;
    }
    if (isset($deliveriesCols['items'])) {
        $payload['items'] = json_encode($itemsPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    if (isset($deliveriesCols['total'])) {
        $payload['total'] = $deliveryTotal;
    }
    if (isset($deliveriesCols['status'])) {
        $payload['status'] = 'pending';
    }

    // Upsert by order_id if possible
    $existing = DB::table('deliveries')
        ->when(isset($deliveriesCols['order_id']), fn($q) => $q->where('order_id', $order->id))
        ->first();

    if ($existing) {
        DB::table('deliveries')
            ->where('id', $existing->id)
            ->update($payload);
    } else {
        if (isset($deliveriesCols['created_at'])) {
            $payload['created_at'] = now();
        }
        DB::table('deliveries')->insert($payload);
    }

    return redirect()
        ->route('vendor.orders.show', $order->id)
        ->with('success', 'Order confirmed and sent to Delivery.');
}
}