<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketballController extends Controller
{
    public function index()
{
    $items = \App\Models\BasketballEquipment::all(); // or whatever your model is
    return view('admin.basketball.dashboard', compact('items'));
}

}
