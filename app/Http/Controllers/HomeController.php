<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CricketEquipment; // ✅ Add this line to import the model

class HomeController extends Controller
{
    public function index()
    {
        $items = CricketEquipment::all(); // ✅ Fetch all cricket items from DB

        return view('admin.cricket.dashboard', compact('items')); // ✅ Pass them to the view
    }
}
