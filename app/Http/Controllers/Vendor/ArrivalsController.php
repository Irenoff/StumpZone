<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArrivalsController extends Controller
{
    // LIST
    public function index()
    {
        $items = DB::table('arrivals')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('vendor_panel.arrivals.index', compact('items'));
    }

    public function create() { abort(404); }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:255'],
            'sport'       => ['required','in:cricket,football,basketball,badminton,boxing'],
            'description' => ['required','string'],
            'price'       => ['required','numeric','min:0.01','max:99999999.99'],
            'stock'       => ['nullable','integer','min:0'],
            'status'      => ['nullable','string','max:255'],
            'image'       => ['nullable','image','max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('arrivals', 'public');
        }

        DB::table('arrivals')->insert([
            'title'       => $data['title'],
            'sport'       => $data['sport'],
            'description' => $data['description'],
            'price'       => (float)$data['price'],
            'stock'       => (int)($data['stock'] ?? 0),
            'image_path'  => $path,
            'status'      => $data['status'] ?? 'available',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('vendor.arrivals.index')
            ->with('success', 'Arrival added successfully.');
    }

    // EDIT
    public function edit($arrival)
    {
        $item = DB::table('arrivals')->find($arrival);
        abort_unless($item, 404);
        return view('vendor_panel.arrivals.edit', compact('item'));
    }

    // UPDATE
    public function update(Request $request, $arrival)
    {
        $item = DB::table('arrivals')->find($arrival);
        abort_unless($item, 404);

        $data = $request->validate([
            'title'       => ['required','string','max:255'],
            'sport'       => ['required','in:cricket,football,basketball,badminton,boxing'],
            'description' => ['required','string'],
            'price'       => ['required','numeric','min:0.01','max:99999999.99'],
            'stock'       => ['nullable','integer','min:0'],
            'status'      => ['nullable','string','max:255'],
            'image'       => ['nullable','image','max:4096'],
        ]);

        $path = $item->image_path;
        if ($request->hasFile('image')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('image')->store('arrivals', 'public');
        }

        DB::table('arrivals')->where('id', $arrival)->update([
            'title'       => $data['title'],
            'sport'       => $data['sport'],
            'description' => $data['description'],
            'price'       => (float)$data['price'],
            'stock'       => (int)($data['stock'] ?? 0),
            'image_path'  => $path,
            'status'      => $data['status'] ?? 'available',
            'updated_at'  => now(),
        ]);

        return redirect()->route('vendor.arrivals.index')
            ->with('success', 'Arrival updated.');
    }

    // DELETE ONE
    public function destroy($arrival)
    {
        $item = DB::table('arrivals')->find($arrival);
        if ($item) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            DB::table('arrivals')->where('id', $arrival)->delete();
        }
        return back()->with('success', 'Arrival deleted.');
    }

    // BULK DELETE
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || !count($ids)) {
            return back()->with('error','No items selected.');
        }

        $rows = DB::table('arrivals')->whereIn('id', $ids)->get();
        foreach ($rows as $row) {
            if ($row->image_path) {
                Storage::disk('public')->delete($row->image_path);
            }
        }

        DB::table('arrivals')->whereIn('id', $ids)->delete();

        return back()->with('success','Selected arrivals deleted.');
    }
}
