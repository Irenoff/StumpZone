<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeliveryController extends Controller
{
    /**
     * Show deliveries only after vendor confirmation/release.
     * Default view = ALL STATUSES (pending, delivered, cancelled).
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = trim((string) $request->query('search', ''));

        $q = DB::table('deliveries as d')
            ->leftJoin('orders as o', 'o.id', '=', 'd.order_id')
            ->select(
                'd.*',
                'o.order_number',
                'o.delivery_method',
                'o.grand_total as order_total',
                'o.status as order_status'
            );

        // Gate: only show after vendor confirmed/released
        if (Schema::hasColumn('deliveries', 'is_vendor_confirmed')) {
            $q->where('d.is_vendor_confirmed', true);
        } elseif (Schema::hasColumn('deliveries', 'released_at')) {
            $q->whereNotNull('d.released_at');
        } else {
            // Fallback: rely on order status
            $q->whereIn('o.status', ['confirmed', 'ready', 'ready_to_ship', 'out_for_delivery', 'delivered', 'cancelled']);
        }

        // Optional status filter only when explicitly requested
        if ($status && in_array($status, ['pending', 'delivered', 'cancelled'], true)) {
            $q->where('d.status', $status);
        }

        // Optional search
        if ($search !== '') {
            $q->where(function ($w) use ($search) {
                // Use 'like' if on MySQL; 'ilike' for Postgres
                $w->where('d.customer_name', 'like', "%{$search}%")
                  ->orWhere('d.customer_email', 'like', "%{$search}%")
                  ->orWhere('d.order_number', 'like', "%{$search}%")
                  ->orWhere('d.customer_address', 'like', "%{$search}%");
            });
        }

        $deliveries = $q->orderByDesc('d.id')->paginate(12);

        return view('deliver_panel.dashboard', compact('deliveries'));
    }

    /**
     * Mark a delivery as delivered and return to ALL deliveries (no filter).
     */
    public function delivered($deliveryId)
    {
        $row = DB::table('deliveries')->where('id', $deliveryId)->first();
        if (!$row) {
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Delivery not found.');
        }

        if (($row->status ?? 'pending') !== 'pending') {
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Only pending deliveries can be marked as delivered.');
        }

        DB::beginTransaction();
        try {
            DB::table('deliveries')->where('id', $deliveryId)->update([
                'status'       => 'delivered',
                'delivered_at' => now(),
                'updated_at'   => now(),
            ]);

            if ($row->order_id) {
                DB::table('orders')->where('id', $row->order_id)->update([
                    'status'     => 'delivered',
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            // IMPORTANT: redirect to the dashboard route WITHOUT the ?status=pending query
            return redirect()->route('deliver.delivery.dashboard')->with('success', 'Delivery marked as delivered.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Could not mark as delivered.');
        }
    }

    /**
     * Cancel a delivery and return to ALL deliveries (no filter).
     */
    public function cancelled($deliveryId)
    {
        $row = DB::table('deliveries')->where('id', $deliveryId)->first();
        if (!$row) {
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Delivery not found.');
        }

        if (($row->status ?? 'pending') !== 'pending') {
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Only pending deliveries can be cancelled.');
        }

        DB::beginTransaction();
        try {
            DB::table('deliveries')->where('id', $deliveryId)->update([
                'status'       => 'cancelled',
                'cancelled_at' => now(),
                'updated_at'   => now(),
            ]);

            if ($row->order_id) {
                DB::table('orders')->where('id', $row->order_id)->update([
                    'status'     => 'cancelled',
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            // IMPORTANT: redirect to dashboard without any status filter
            return redirect()->route('deliver.delivery.dashboard')->with('success', 'Delivery cancelled.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return redirect()->route('deliver.delivery.dashboard')->with('error', 'Could not cancel the delivery.');
        }
    }
}
