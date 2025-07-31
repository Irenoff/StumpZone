<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FootballEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FootballEquipmentController extends Controller
{
    public function index()
    {
        $items = FootballEquipment::latest()->paginate(10);
        return view('admin.football.dashboard', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'size' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment_images', 'public');
            $data['image_path'] = $imagePath;
        }

        FootballEquipment::create($data);

        return redirect()->route('admin.football.dashboard')->with('success', 'Item added successfully!');
    }

    public function edit($id)
    {
        $item = FootballEquipment::findOrFail($id);
        return view('admin.football.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = FootballEquipment::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'size' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }

            $data['image_path'] = $request->file('image')->store('equipment_images', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.football.dashboard')->with('success', 'Item updated successfully!');
    }

    public function destroy($id)
    {
        $item = FootballEquipment::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('admin.football.dashboard')->with('success', 'Item deleted successfully!');
    }
}
