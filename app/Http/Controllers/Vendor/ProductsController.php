<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /** map sport => table + pretty name + emoji */
    private const SPORT_META = [
        'cricket'    => ['table' => 'cricket_equipment',    'label' => 'Cricket',    'emoji' => '🏏'],
        'football'   => ['table' => 'football_equipment',   'label' => 'Football',   'emoji' => '⚽'],
        'basketball' => ['table' => 'basketball_equipment', 'label' => 'Basketball', 'emoji' => '🏀'],
        'badminton'  => ['table' => 'badminton_equipment',  'label' => 'Badminton',  'emoji' => '🏸'],
        'boxing'     => ['table' => 'boxing_equipment',     'label' => 'Boxing',     'emoji' => '🥊'],
    ];

    /** small guard */
    private function meta(string $sport): array
    {
        $sport = strtolower($sport);
        abort_unless(isset(self::SPORT_META[$sport]), 404, 'Unknown sport');
        return ['key' => $sport] + self::SPORT_META[$sport];
    }

    /** /vendor/products – hub page with 5 buttons */
    public function home()
    {
        return view('vendor_panel.products.home');
    }

    /** list items for a sport */
    public function index(Request $request, string $sport)
    {
        $m = $this->meta($sport);

        $q = trim((string) $request->get('q'));
        $query = DB::table($m['table'])->orderByDesc('created_at');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'ILIKE', "%{$q}%")
                  ->orWhere('description', 'ILIKE', "%{$q}%");
            });
        }

        $items = $query->paginate(12)->withQueryString();

        return view('vendor_panel.products.manage', [
            'sport'      => $m['key'],
            'sportLabel' => $m['emoji'].' '.$m['label'],
            'items'      => $items,
            'q'          => $q,
        ]);
    }

    /** create */
    public function store(Request $request, string $sport)
    {
        $m = $this->meta($sport);

        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['required','string'],
            'price'       => ['required','numeric','min:0'],
            'status'      => ['nullable','in:available,out_of_stock,pre_order'],
            'quantity'    => ['required','integer','min:0'],
            'image'       => ['nullable','image','max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('equipment_images', 'public');
        }

        DB::table($m['table'])->insert([
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'image_path'  => $path,
            'status'      => $data['status'] ?? 'available',
            'quantity'    => $data['quantity'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return back()->with('success', "{$m['label']} item created.");
    }

    /** edit form */
    public function edit(string $sport, int $id)
    {
        $m = $this->meta($sport);

        $item = DB::table($m['table'])->where('id', $id)->first();
        abort_if(!$item, 404);

        return view('vendor_panel.products.edit', [
            'sport'      => $m['key'],
            'sportLabel' => $m['emoji'].' '.$m['label'],
            'item'       => $item,
        ]);
    }

    /** update */
    public function update(Request $request, string $sport, int $id)
    {
        $m = $this->meta($sport);

        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['required','string'],
            'price'       => ['required','numeric','min:0'],
            'status'      => ['nullable','in:available,out_of_stock,pre_order'],
            'quantity'    => ['required','integer','min:0'],
            'image'       => ['nullable','image','max:4096'],
        ]);

        $row = DB::table($m['table'])->where('id', $id)->first();
        abort_if(!$row, 404);

        $update = [
            'name'        => $data['name'],
            'description' => $data['description'],
            'price'       => $data['price'],
            'status'      => $data['status'] ?? 'available',
            'quantity'    => $data['quantity'],
            'updated_at'  => now(),
        ];

        if ($request->hasFile('image')) {
            // delete old file if exists
            if (!empty($row->image_path)) {
                Storage::disk('public')->delete($row->image_path);
            }
            $update['image_path'] = $request->file('image')->store('equipment_images', 'public');
        }

        DB::table($m['table'])->where('id', $id)->update($update);

        return redirect()
            ->route('vendor.products.index', ['sport' => $m['key']])
            ->with('success', "{$m['label']} item updated.");
    }

    /** delete */
    public function destroy(string $sport, int $id)
    {
        $m = $this->meta($sport);

        $row = DB::table($m['table'])->where('id', $id)->first();
        abort_if(!$row, 404);

        if (!empty($row->image_path)) {
            Storage::disk('public')->delete($row->image_path);
        }

        DB::table($m['table'])->where('id', $id)->delete();

        return back()->with('success', "{$m['label']} item deleted.");
    }
}
