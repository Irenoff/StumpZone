<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * GET /orders
     * Paginated list of the current user's orders.
     * Includes items + delivery so the view can show live status badges.
     */
    public function index(): View
    {
        $orders = Order::with(['items', 'delivery'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        // Tip: your Blade can read $order->status for overall status
        // and optionally $order->delivery?->status for delivery detail.
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * GET /orders/{order}
     * Show a single order; enrich items with sport/name/price if missing.
     * Also loads delivery so status is reflected precisely.
     */
    public function show(Order $order): View
    {
        // Only the owner can view
        abort_unless($order->user_id === Auth::id(), 403);

        // Load items + delivery record (if created when vendor confirmed)
        $order->load(['items', 'delivery']);

        // Map table -> sport label (equipment tables don't have sport_type columns)
        $tableToSport = [
            'cricket_equipment'    => 'Cricket',
            'football_equipment'   => 'Football',
            'basketball_equipment' => 'Basketball',
            'badminton_equipment'  => 'Badminton',
            'boxing_equipment'     => 'Boxing',
        ];

        // Enrich each item (fill missing unit_price/name, attach display_sport, guarantee line_total)
        $items = $order->items->map(function ($i) use ($tableToSport) {
            $sport = 'N/A';

            // If this row refers to an equipment item, try to look up its name/price
            if (isset($i->item_type) && $i->item_type === 'equipment' && !empty($i->item_id)) {
                foreach ($tableToSport as $tbl => $sportName) {
                    // Only select columns that should exist in your tables
                    $query = DB::table($tbl)->select('price', 'name')->where('id', $i->item_id);

                    // If the table doesn't exist, skip silently
                    try {
                        $row = $query->first();
                    } catch (\Throwable $e) {
                        $row = null;
                    }

                    if ($row) {
                        $sport = $sportName;

                        // Backfill for legacy rows if needed
                        if (is_null($i->unit_price) && isset($row->price)) {
                            $i->unit_price = (float) $row->price;
                        }
                        if (is_null($i->name) && !empty($row->name)) {
                            $i->name = $row->name;
                        }
                        break;
                    }
                }
            }

            // Attach a friendly sport label for the view
            $i->display_sport = $sport;

            // Ensure line_total is present
            if (is_null($i->line_total)) {
                $qty  = (int) ($i->quantity ?? 0);
                $unit = (float) ($i->unit_price ?? 0);
                $i->line_total = round($qty * $unit, 2);
            }

            return $i;
        });

        // Prefer stored items_total; otherwise compute from items
        $itemsTotal = $order->items_total ?? $items->sum('line_total');

        // Delivery status (optional convenience variable for the view)
        $deliveryStatus = optional($order->delivery)->status; // 'pending' | 'delivered' | 'cancelled' | null

        return view('customer.orders.show', [
            'order'          => $order,
            'items'          => $items,
            'itemsTotal'     => $itemsTotal,
            'deliveryStatus' => $deliveryStatus,
        ]);
    }
}
