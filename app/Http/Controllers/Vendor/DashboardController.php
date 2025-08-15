<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount     = DB::table('orders')->count();
        $customersCount  = DB::table('orders')->distinct('user_id')->count('user_id');
        $itemsOrderedSum = DB::table('order_items')->sum('quantity');

        // Sum all products across equipment tables
        $productsCount = 0;
        $equipmentTables = [
            'cricket_equipment',
            'football_equipment',
            'basketball_equipment',
            'badminton_equipment',
            'boxing_equipment',
        ];
        foreach ($equipmentTables as $tbl) {
            if (DB::getSchemaBuilder()->hasTable($tbl)) {
                $productsCount += DB::table($tbl)->count();
            }
        }

        // Provide BOTH names so the Blade can use either
        $productsTotal = $productsCount;

        $recentOrders = Order::orderByDesc('created_at')->limit(8)->get();

        return view('vendor_panel.dashboard', compact(
            'ordersCount',
            'customersCount',
            'itemsOrderedSum',
            'productsCount',
            'productsTotal',
            'recentOrders'
        ));
    }
}
