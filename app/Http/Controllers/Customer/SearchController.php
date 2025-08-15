<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Corrected model names based on your actual filenames
use App\Models\CricketEquipment;
use App\Models\FootballEquipment;
use App\Models\BadmintonEquipment;
use App\Models\BasketballEquipment;
use App\Models\BoxingEquipment;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = collect()
            ->merge(CricketEquipment::where('name', 'like', "%$query%")->get())
            ->merge(FootballEquipment::where('name', 'like', "%$query%")->get())
            ->merge(BadmintonEquipment::where('name', 'like', "%$query%")->get())
            ->merge(BasketballEquipment::where('name', 'like', "%$query%")->get())
            ->merge(BoxingEquipment::where('name', 'like', "%$query%")->get());

        return view('customer.search_results', compact('results', 'query'));
    }
}
