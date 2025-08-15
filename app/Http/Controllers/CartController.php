<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Order;

class CartController extends Controller
{
    private function redirectToOrders(string $successMsg)
    {
        if (Route::has('customer.orders.index')) {
            return redirect()->route('customer.orders.index')->with('success', $successMsg);
        }
        if (Route::has('orders.index')) {
            return redirect()->route('orders.index')->with('success', $successMsg);
        }
        return redirect('/orders')->with('success', $successMsg);
    }

    /**
     * Try to find a product in sport table, then arrivals, then offers.
     * Returns: ['table' => string, 'product' => object|null, 'stock_col' => 'quantity'|'stock'|null]
     */
    private function findProduct(string $sportType, int $equipmentId): array
    {
        $sportTable = $this->getTableFromSport($sportType, false); // don't throw
        $candidates = [];

        if ($sportTable && Schema::hasTable($sportTable)) {
            $candidates[] = $sportTable;
        }
        if (Schema::hasTable('arrivals')) {
            $candidates[] = 'arrivals';
        }
        if (Schema::hasTable('offers')) {
            $candidates[] = 'offers';
        }

        foreach ($candidates as $tbl) {
            $product = DB::table($tbl)->where('id', $equipmentId)->first();
            if ($product) {
                $stockCol = Schema::hasColumn($tbl, 'quantity')
                    ? 'quantity'
                    : (Schema::hasColumn($tbl, 'stock') ? 'stock' : null);

                return ['table' => $tbl, 'product' => $product, 'stock_col' => $stockCol];
            }
        }

        return ['table' => $sportTable ?: 'unknown', 'product' => null, 'stock_col' => null];
    }

    private function productName($p): string
    {
        return (string) ($p->name ?? $p->title ?? 'Unknown');
    }

    private function productPrice($p): float
    {
        return (float) ($p->price ?? 0);
    }

    private function productSize($p): string
    {
        return (string) ($p->size ?? 'N/A');
    }

    private function productImage($p): ?string
    {
        return $p->image_path ?? ($p->image ?? null);
    }

    private function productStock($p, ?string $stockCol): ?int
    {
        if (!$stockCol) return null;
        return isset($p->{$stockCol}) ? (int) $p->{$stockCol} : null;
    }

    private function decrementStock(string $table, int $id, int $qty): void
    {
        // Choose the right stock column
        if (Schema::hasColumn($table, 'quantity')) {
            DB::table($table)->where('id', $id)->decrement('quantity', $qty);
        } elseif (Schema::hasColumn($table, 'stock')) {
            DB::table($table)->where('id', $id)->decrement('stock', $qty);
        }
        // If neither exists, skip (no stock to decrement)
    }

    public function view()
    {
        $cartRows = DB::table('carts')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        $items = [];
        foreach ($cartRows as $cart) {
            $found = $this->findProduct((string) $cart->sport_type, (int) $cart->equipment_id);
            if (!$found['product']) continue;

            $p     = $found['product'];
            $price = $this->productPrice($p);
            $qty   = max(1, (int)($cart->quantity ?? 1));
            $stock = $this->productStock($p, $found['stock_col']);

            $items[] = (object)[
                'id'           => (int)$cart->id,            // cart row id
                'equipment_id' => (int)$cart->equipment_id,  // product id
                'sport_type'   => $cart->sport_type,
                'name'         => $this->productName($p),
                'size'         => $this->productSize($p),
                'price'        => $price,
                'quantity'     => $qty,
                'subtotal'     => $price * $qty,
                'image_path'   => $this->productImage($p),
                'stock'        => $stock,
            ];
        }

        return view('customer.cart', ['items' => $items]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|integer|min:1',
            'sport_type'   => 'required|string|max:50',
            'quantity'     => 'nullable|integer|min:1',
            // optional flags from your forms
            'is_arrival'   => 'nullable|in:0,1',
            'is_offer'     => 'nullable|in:0,1',
            'size'         => 'nullable|string|max:50',
        ]);

        $quantity = max(1, (int)($request->quantity ?? 1));

        // Merge by (user_id, equipment_id, sport_type)
        $existing = DB::table('carts')
            ->where('user_id', Auth::id())
            ->where('equipment_id', $request->equipment_id)
            ->where('sport_type', $request->sport_type)
            ->first();

        if ($existing) {
            DB::table('carts')->where('id', $existing->id)->update([
                'quantity'   => (int)$existing->quantity + $quantity,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('carts')->insert([
                'user_id'      => Auth::id(),
                'equipment_id' => (int)$request->equipment_id,
                'sport_type'   => (string)$request->sport_type, // keep as provided (arrivals use sport label here)
                'quantity'     => $quantity,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        DB::table('carts')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'quantity'   => (int)$request->quantity,
                'updated_at' => now(),
            ]);

        return redirect()->route('cart.view')->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        DB::table('carts')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        DB::table('carts')->where('user_id', Auth::id())->delete();
        return redirect()->route('cart.view')->with('success', 'Cart cleared.');
    }

    public function paymentPage(Request $request)
    {
        $userId      = Auth::id();
        $successText = 'Order placed successfully. Your order will be delivered to your doorstep as soon as possible.';

        $selected = collect((array)$request->input('selected', []))
            ->map(fn($v) => (int)$v)->filter()->unique()->values()->all();

        $qtyInput = (array)$request->input('quantities', session('quantities_override', []));

        $deliveryMethod = $request->input('delivery_method', old('delivery_method', 'standard'));
        $deliveryFee    = (float)$request->input('delivery_fee', old('delivery_fee', 0));

        if (empty($selected)) {
            return redirect()->route('cart.view')->with('error', 'Please select at least one item to pay.');
        }

        $cartRows = DB::table('carts')
            ->where('user_id', $userId)
            ->whereIn('id', $selected)
            ->orderBy('id', 'desc')
            ->get();

        if ($cartRows->isEmpty()) {
            if (!DB::table('carts')->where('user_id', $userId)->exists()) {
                return $this->redirectToOrders($successText);
            }
            return redirect()->route('cart.view')->with('success', $successText);
        }

        $items = [];
        $total = 0.0;

        foreach ($cartRows as $cart) {
            $found = $this->findProduct((string) $cart->sport_type, (int) $cart->equipment_id);
            if (!$found['product']) continue;

            $p   = $found['product'];
            $qty = isset($qtyInput[$cart->id]) ? (int)$qtyInput[$cart->id] : (int)$cart->quantity;
            $qty = max($qty, 1);

            $price    = $this->productPrice($p);
            $subtotal = $price * $qty;
            $total   += $subtotal;

            $items[] = (object)[
                'cart_id'      => (int)$cart->id,
                'equipment_id' => (int)$cart->equipment_id,
                'sport_type'   => $cart->sport_type,
                'name'         => $this->productName($p),
                'size'         => $this->productSize($p),
                'price'        => $price,
                'quantity'     => $qty,
                'subtotal'     => $subtotal,
                'image_path'   => $this->productImage($p),
            ];
        }

        return view('customer.cart.payment', [
            'items'           => $items,
            'total'           => $total,
            'selected'        => $selected,
            'stock_errors'    => (array)session('stock_errors', []),
            'delivery_method' => $deliveryMethod,
            'delivery_fee'    => $deliveryFee,
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'selected'        => 'required|array|min:1',
            'selected.*'      => 'integer|min:1',
            'amount'          => 'required|numeric|min:0',
            'quantities'      => 'nullable|array',
            'delivery_method' => 'required|string|in:standard,express,overnight',
            'delivery_fee'    => 'required|numeric|min:0',
        ]);

        $userId     = Auth::id();
        $successMsg = 'Order placed successfully. Your order will be delivered to your doorstep as soon as possible.';

        $selected = collect($request->input('selected', []))
            ->map(fn($v) => (int)$v)->filter()->unique()->values()->all();

        $amount         = (float)$request->input('amount');
        $qtyInput       = (array)$request->input('quantities', []);
        $deliveryMethod = $request->input('delivery_method');
        $deliveryFee    = (float)$request->input('delivery_fee');

        $cartRows = DB::table('carts')
            ->where('user_id', $userId)
            ->whereIn('id', $selected)
            ->orderBy('id', 'desc')
            ->get();

        if ($cartRows->isEmpty()) {
            return $this->redirectToOrders($successMsg);
        }

        $itemsTotal   = 0.0;
        $lineItems    = [];
        $stockErrors  = [];
        $qtyOverrides = $qtyInput;
        $sumQty       = 0;

        DB::beginTransaction();
        try {
            foreach ($cartRows as $cart) {
                $found = $this->findProduct((string) $cart->sport_type, (int) $cart->equipment_id);
                if (!$found['product']) {
                    DB::rollBack();
                    return back()->with('error', 'One of the items is no longer available.')->withInput();
                }

                $p        = $found['product'];
                $stockCol = $found['stock_col'];
                $stock    = $this->productStock($p, $stockCol);

                $qty = isset($qtyInput[$cart->id]) ? (int)$qtyInput[$cart->id] : (int)$cart->quantity;
                $qty = max($qty, 1);

                if (!is_null($stock) && $stock > 0 && $qty > $stock) {
                    $stockErrors[] = "{$this->productName($p)} has only {$stock} left.";
                    $qtyOverrides[$cart->id] = 1;
                    continue;
                }

                $price    = $this->productPrice($p);
                $subtotal = $price * $qty;

                $itemsTotal += $subtotal;
                $sumQty     += $qty;

                $lineItems[] = [
                    'sport_type'   => (string) $cart->sport_type,
                    'equipment_id' => (int) $cart->equipment_id,
                    'name'         => $this->productName($p),
                    'quantity'     => $qty,
                    'price'        => $price,
                    'subtotal'     => $subtotal,
                    'product_tbl'  => $found['table'],
                ];
            }

            if (!empty($stockErrors)) {
                DB::rollBack();
                return redirect()
                    ->route('customer.cart.payment', ['selected' => $selected])
                    ->with('stock_errors', $stockErrors)
                    ->with('quantities_override', $qtyOverrides)
                    ->withInput($request->only('amount', 'delivery_method', 'delivery_fee'));
            }

            $grandTotal = $itemsTotal + $deliveryFee;

            if ($amount < $grandTotal) {
                DB::rollBack();
                return redirect()
                    ->route('customer.cart.payment', ['selected' => $selected])
                    ->with('error', 'Insufficient amount. Please enter an amount equal to or greater than the total.')
                    ->with('quantities_override', $qtyInput)
                    ->withInput($request->only('amount', 'delivery_method', 'delivery_fee'));
            }

            $user  = Auth::user();
            $order = Order::create([
                'user_id'            => $userId,
                'order_number'       => 'SZ-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'items_total'        => $itemsTotal,
                'delivery_fee'       => $deliveryFee,
                'grand_total'        => $grandTotal,
                'status'             => 'processing',
                'processing_message' => 'We received your order and will start processing shortly.',
                'customer_email'     => $user->email ?? null,
                'customer_address'   => $user->address ?? null,
                'delivery_method'    => $deliveryMethod,

                // legacy single-item columns (safe fillers)
                'sport_type'   => 'mixed',
                'equipment_id' => 0,
                'quantity'     => $sumQty,
                'price'        => 0,
                'total'        => $grandTotal,
            ]);

            // Map into order_items using flexible column set
            $cols = Schema::getColumnListing('order_items');
            $has  = fn(string $c) => in_array($c, $cols, true);

            $rows = [];
            foreach ($lineItems as $li) {
                $row = [
                    'order_id'   => $order->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if ($has('quantity')) $row['quantity'] = $li['quantity'];

                foreach (['unit_price','price','unit_amount','unit_cost'] as $uc) {
                    if ($has($uc)) $row[$uc] = $li['price'];
                }
                foreach (['line_total','line_amount','subtotal','total_price','total'] as $tc) {
                    if ($has($tc)) $row[$tc] = $li['subtotal'];
                }
                foreach (['name','item_name','product_name'] as $nc) {
                    if ($has($nc)) $row[$nc] = $li['name'];
                }
                if ($has('sport_type')) $row['sport_type'] = $li['sport_type'];
                foreach (['item_id','product_id','equipment_id','product_ref_id'] as $pc) {
                    if ($has($pc)) $row[$pc] = $li['equipment_id'];
                }
                foreach (['item_type','type'] as $tc) {
                    if ($has($tc)) $row[$tc] = 'equipment';
                }

                $rows[] = $row;
            }

            if (!empty($rows)) {
                DB::table('order_items')->insert($rows);
            }

            // Decrement stock in the right table/column
            foreach ($lineItems as $li) {
                $this->decrementStock($li['product_tbl'], $li['equipment_id'], $li['quantity']);
            }

            // Clear purchased rows
            DB::table('carts')
                ->where('user_id', $userId)
                ->whereIn('id', $selected)
                ->delete();

            DB::commit();
            return $this->redirectToOrders($successMsg);

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $msg = app()->isLocal()
                ? 'Payment error: '.$e->getMessage()
                : 'Something went wrong while processing your payment.';
            return back()->with('error', $msg)->withInput();
        }
    }

    /**
     * When $strict=false, returns null on unknown; with true, throws.
     */
    private function getTableFromSport(string $sportType, bool $strict = true): ?string
    {
        $table = match (strtolower($sportType)) {
            'cricket'    => 'cricket_equipment',
            'football'   => 'football_equipment',
            'basketball' => 'basketball_equipment',
            'badminton'  => 'badminton_equipment',
            'boxing'     => 'boxing_equipment',
            default      => null,
        };

        if (!$table && $strict) {
            throw new \RuntimeException("Unknown sport type: {$sportType}");
        }

        return $table;
    }
}
