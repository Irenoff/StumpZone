<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        $arrivals = DB::table('arrivals')
            ->whereIn('status', ['available','active'])
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('customer.offers', compact('arrivals'));
    }
}
