<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BadmintonEquipment;
use Illuminate\Support\Facades\Storage;

class BadmintonController extends Controller
{
    // ✅ Show all items on dashboard
    public function dashboard()
    {
        $items = BadmintonEquipment::latest()->paginate(10);
        return view('admin.badminton.dashboard', compact('items'));
    }

    // ✅ Store new equipment
   public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
    'description' => 'required|string',
    'price'       => 'required|numeric|min:0.01',
    'quantity'    => 'required|integer|min:0',
    'status'      => 'nullable|string',
    'size' => 'nullable|string|max:20',
    'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('badminton', 'public');

        }

        BadmintonEquipment::create($validated);

        return redirect()->back()->with('success', 'Badminton equipment added successfully!');
    }


    // ✅ Update equipment
    public function update(Request $request, $id)
    {
        $item = BadmintonEquipment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:500',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'size' => 'nullable|string|max:20', // ✅ ADD THIS

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image replacement
    $imagePath = $item->image_path;
if ($request->hasFile('image')) {
    if ($item->image_path) {
        Storage::disk('public')->delete($item->image_path);
    }
    $imagePath = $request->file('image')->store('badminton', 'public');
}


        $item->update([
            'name' => $validated['name'],
            
            'price' => $validated['price'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'status' => $validated['status'],
            'size' => $validated['size'],
            'image_path' => $imagePath, // ✅ CORRECT

        ]);

        return redirect()->route('admin.badminton.dashboard')
                         ->with('success', 'Item updated successfully');
    }

    // ✅ Delete equipment
    public function destroy($id)
    {
        $item = BadmintonEquipment::findOrFail($id);

        if ($item->image_url) {
            Storage::disk('public')->delete($item->image_url);
        }

        $item->delete();

        return redirect()->route('admin.badminton.dashboard')
                         ->with('success', 'Item deleted successfully');
    }

    public function edit($id)
{
    $item = BadmintonEquipment::findOrFail($id);
    return view('admin.badminton.edit', compact('item'));
}

}
