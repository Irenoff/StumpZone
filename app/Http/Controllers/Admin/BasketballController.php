<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasketballEquipment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BasketballController extends Controller
{
    // Show all basketball equipment
    public function index()
    {
        $items = BasketballEquipment::all();
        return view('admin.basketball.dashboard', compact('items'));
    }

    // Store new basketball equipment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'status' => 'required|string',
            'size' => 'nullable|string|max:50',
           
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('basketball_images', 'public');
            $validated['image_path'] = $imagePath;
        }

        BasketballEquipment::create($validated);

        return redirect()->route('admin.basketball.dashboard')->with('success', 'Basketball item added.');
    }

    // Show the edit form
   public function edit($id)
{
    $basketball = BasketballEquipment::findOrFail($id);
    return view('admin.basketball.edit', compact('basketball')); // ✅ Match Blade
}


    // Update existing basketball equipment
    public function update(Request $request, $id)
    {
        $item = BasketballEquipment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'status' => 'required|string',
            'size' => 'nullable|string|max:50',
            
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('basketball_images', 'public');
        }

        $item->update($validated);

        return redirect()->route('admin.basketball.dashboard')->with('success', 'Basketball item updated.');
    }

    // Delete basketball equipment
    public function destroy($id)
    {
        $item = BasketballEquipment::findOrFail($id);

        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('admin.basketball.dashboard')->with('success', 'Basketball item deleted.');
    }
}
