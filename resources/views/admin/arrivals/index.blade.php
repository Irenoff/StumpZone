@extends('admin.layouts.app')
@section('title','Admin • New Arrivals')

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-white">New Arrivals (Admin)</h1>

    @if(session('success'))
        <div class="p-3 mb-4 text-sm text-green-200 border rounded-lg bg-green-800/40 border-green-600/40">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="p-3 mb-4 text-sm border rounded-lg text-rose-200 bg-rose-800/40 border-rose-600/40">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Form --}}
    <div class="p-6 mb-8 border rounded-xl bg-white/5 border-white/10">
        <h2 class="mb-4 text-lg font-semibold text-white">Add Arrival</h2>
        <form method="POST" action="{{ route('admin.arrivals.store') }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
            @csrf

            <div>
                <label class="block mb-1 text-sm text-slate-200">Title</label>
                <input name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Sport</label>
                <select name="sport" required class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10">
                    <option value="" disabled {{ old('sport') ? '' : 'selected' }}>Select sport</option>
                    <option value="cricket"     @selected(old('sport')==='cricket')>Cricket</option>
                    <option value="football"    @selected(old('sport')==='football')>Football</option>
                    <option value="basketball"  @selected(old('sport')==='basketball')>Basketball</option>
                    <option value="badminton"   @selected(old('sport')==='badminton')>Badminton</option>
                    <option value="boxing"      @selected(old('sport')==='boxing')>Boxing</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-sm text-slate-200">Description</label>
                <textarea name="description" rows="3" required
                          class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Price</label>
                <input type="number" name="price" step="0.01" min="0.01" value="{{ old('price') }}" required
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Stock</label>
                <input type="number" name="stock" min="0" step="1" value="{{ old('stock', 0) }}"
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Status</label>
                <select name="status" class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10">
                    <option value="available"    @selected(old('status')==='available')>Available</option>
                    <option value="out_of_stock" @selected(old('status')==='out_of_stock')>Out of Stock</option>
                    <option value="pre_order"    @selected(old('status')==='pre_order')>Pre-order</option>
                    <option value="active"       @selected(old('status')==='active')>Active</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-sm text-slate-200">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 file:bg-white/10 file:border-0 file:mr-3">
            </div>

            <div class="flex justify-end gap-3 md:col-span-2">
                <button type="submit" class="px-5 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>

    {{-- List --}}
    <div class="overflow-hidden border rounded-xl border-white/10">
        <table class="min-w-full text-sm text-slate-200">
            <thead class="text-white bg-white/10">
                <tr>
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Sport</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Stock</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Created</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($items as $item)
                    <tr class="hover:bg-white/5">
                        <td class="px-4 py-3">
                            @if($item->image_path)
                                <img src="{{ asset('storage/'.$item->image_path) }}" class="object-cover w-12 h-12 border rounded-md border-white/10" alt="">
                            @else
                                <div class="grid w-12 h-12 border rounded-md bg-white/10 border-white/10 place-content-center">—</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-white">{{ $item->title }}</div>
                            <div class="text-xs text-slate-400">{{ \Illuminate\Support\Str::limit($item->description, 60) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs capitalize border rounded-md bg-white/10 border-white/10">
                                {{ $item->sport }}
                            </span>
                        </td>
                        <td class="px-4 py-3">LKR {{ number_format((float)$item->price, 2) }}</td>
                        <td class="px-4 py-3">{{ is_null($item->stock) ? '—' : (int)$item->stock }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs border rounded-md bg-white/10 border-white/10">
                                {{ str_replace('_',' ', ucfirst($item->status ?? 'available')) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.arrivals.edit', $item->id) }}"
                               class="inline-block px-3 py-1 text-white bg-blue-600 rounded-md hover:bg-blue-700">Edit</a>

                            <form action="{{ route('admin.arrivals.destroy', $item->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this arrival?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-white rounded-md bg-rose-600 hover:bg-rose-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-4 py-6 text-center text-slate-400">No arrivals yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ method_exists($items,'links') ? $items->links('vendor.pagination.tailwind') : '' }}
    </div>
</div>
@endsection
