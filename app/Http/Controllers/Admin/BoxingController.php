<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoxingEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoxingController extends Controller
{
public function dashboard()
{
    $items = Boxingequipment::all();
    return view('admin.boxing.dashboard', compact('items'));
}

    public function create()
    {
        return view('admin.boxing.create');
    }

    public function store(Request $request)

{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
      
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'quantity' => 'required|integer',
        'status' => 'required|string',
        'size' => 'required|string',
        'weight_class' => 'nullable|string',
        'color' => 'nullable|string',
        'brand' => 'nullable|string',
        'material' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('boxing_images', 'public');
        $validated['image_path'] = $path;
    }

    // Save to database
    Boxingequipment::create($validated);

    return redirect()->back()->with('success', 'Boxing equipment added successfully!');
}
    public function show(BoxingEquipment $boxing)
    {
        return view('admin.boxing.show', compact('boxing'));
    }

    public function edit(BoxingEquipment $boxing)
    {
        return view('admin.boxing.edit', compact('boxing'));
    }

    public function update(Request $request, $id)
{
    $boxing = BoxingEquipment::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'status' => 'nullable|string',
        'size' => 'nullable|string',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $boxing->name = $request->name;
    $boxing->price = $request->price;
    $boxing->quantity = $request->quantity;
    $boxing->status = $request->status;
    $boxing->size = $request->size;
    $boxing->description = $request->description;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('boxing_images', 'public');
        $boxing->image_path = $imagePath;
    }

    $boxing->save();

    return redirect()->route('admin.boxing.dashboard')->with('success', 'Boxing equipment updated successfully.');
}


    public function destroy(BoxingEquipment $boxing)
    {
        if ($boxing->image_path) {
            Storage::disk('public')->delete($boxing->image_path);
        }
        $boxing->delete();
        return redirect()->route('admin.boxing.dashboard')->with('success', 'Boxing equipment deleted successfully!');
    }
}
