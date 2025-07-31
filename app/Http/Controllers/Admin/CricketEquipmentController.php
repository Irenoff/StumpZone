<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CricketEquipment;
use Illuminate\Support\Facades\Storage;

class CricketEquipmentController extends Controller
{
    /**
     * Display the cricket equipment list (admin dashboard).
     */
public function index()
{
    $items = CricketEquipment::paginate(10); // ✅ This returns a paginator, not a Collection
    return view('admin.cricket.dashboard', compact('items'));
}


    /**
     * Store a new cricket equipment item.
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0.01',
        'image' => 'nullable|image|max:2048',
        'status' => 'nullable|string',
        'quantity' => 'nullable|integer|min:0'
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('cricket', 'public');
        $validated['image_path'] = $imagePath;
    }

    CricketEquipment::create($validated);

    return redirect()->route('admin.cricket.dashboard')->with('success', 'Equipment added successfully.');
}


    /**
     * Show the edit form for a specific item.
     */
    public function edit($id)
    {
        $item = CricketEquipment::findOrFail($id);
        return view('admin.cricket.edit', compact('item'));
    }

    /**
     * Update the specified cricket equipment.
     */
    public function update(Request $request, $id)
{
    $item = CricketEquipment::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'status' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $data['image_path'] = $request->file('image')->store('equipment_images', 'public');
    }

    $item->update($data);

    return redirect()->route('admin.cricket.dashboard')->with('success', 'Item updated successfully!');
}


    /**
     * Delete a cricket equipment item.
     */
    public function destroy($id)
    {
        $item = CricketEquipment::findOrFail($id);

        // Delete image if exists
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

       return redirect()->route('admin.cricket.dashboard')->with('success', 'Item deleted successfully!');

    }
}
