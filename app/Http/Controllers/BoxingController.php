<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxing;
use App\Models\BoxingEquipment;

class BoxingController extends Controller
{
    public function dashboard()
{
    $items = BoxingEquipment::all(); // Load items from DB
    return view('admin.boxing.dashboard', compact('items'));
}
}