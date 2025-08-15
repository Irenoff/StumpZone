@extends('vendor_panel.layouts.app')
@section('title', "Vendor • $sportLabel")

@section('content')
<div class="max-w-6xl px-4 py-8 mx-auto">

  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">{{ $sportLabel }} • Inventory</h1>

    <form method="GET" class="flex gap-2">
      <input name="q" value="{{ $q }}" placeholder="Search name / description"
             class="px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg w-72">
      <button class="px-4 py-2 border rounded-lg bg-white/10 border-white/10 hover:bg-white/20">Search</button>
    </form>
  </div>

  @if(session('success'))
    <div class="p-3 mb-4 border rounded bg-emerald-500/10 border-emerald-500/30 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  {{-- Add form --}}
  <details class="p-4 mb-6 border rounded-xl bg-white/5 border-white/10">
    <summary class="text-white cursor-pointer">➕ Add New Item</summary>
    <form method="POST" class="mt-4 space-y-4" enctype="multipart/form-data"
          action="{{ route('vendor.products.store',['sport'=>$sport]) }}">
      @csrf
      <div class="grid gap-4 sm:grid-cols-2">
        <div>
          <label class="block mb-1 text-sm text-gray-300">Name</label>
          <input name="name" required class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        </div>
        <div>
          <label class="block mb-1 text-sm text-gray-300">Price</label>
          <input type="number" step="0.01" min="0" name="price" required
                 class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        </div>
        <div>
          <label class="block mb-1 text-sm text-gray-300">Quantity</label>
          <input type="number" min="0" name="quantity" required
                 class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        </div>
        <div>
          <label class="block mb-1 text-sm text-gray-300">Status</label>
          <select name="status" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
            <option value="available">Available</option>
            <option value="out_of_stock">Out of Stock</option>
            <option value="pre_order">Pre-order</option>
          </select>
        </div>
        <div class="sm:col-span-2">
          <label class="block mb-1 text-sm text-gray-300">Image</label>
          <input type="file" name="image" accept="image/*"
                 class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        </div>
        <div class="sm:col-span-2">
          <label class="block mb-1 text-sm text-gray-300">Description</label>
          <textarea name="description" rows="3" required
                    class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg"></textarea>
        </div>
      </div>
      <div class="pt-2">
        <button class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700">Save</button>
      </div>
    </form>
  </details>

  {{-- table --}}
  <div class="overflow-hidden border rounded-xl bg-white/5 border-white/10">
    <table class="min-w-full">
      <thead class="text-sm text-gray-300 bg-white/5">
        <tr>
          <th class="px-4 py-3 text-left">Name</th>
          <th class="px-4 py-3 text-left">Image</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-right">Price</th>
          <th class="px-4 py-3 text-right">Qty</th>
          <th class="px-4 py-3"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/10">
        @forelse($items as $item)
          <tr class="hover:bg-white/5">
            <td class="px-4 py-3">
              <div class="font-semibold text-white">{{ $item->name }}</div>
              <div class="text-xs text-gray-400">{{ Str::limit($item->description, 80) }}</div>
            </td>
            <td class="px-4 py-3">
              @if($item->image_path)
                <img src="{{ asset('storage/'.$item->image_path) }}" class="object-cover w-12 h-12 rounded">
              @else
                <span class="text-xs text-gray-400">No image</span>
              @endif
            </td>
            <td class="px-4 py-3">
              <span class="px-2 py-1 text-xs rounded
                @if($item->status==='available') bg-emerald-900 text-emerald-300
                @elseif($item->status==='out_of_stock') bg-red-900 text-red-300
                @else bg-blue-900 text-blue-300 @endif">
                {{ str_replace('_',' ', ucfirst($item->status ?? 'available')) }}
              </span>
            </td>
            <td class="px-4 py-3 text-right text-emerald-400">Rs. {{ number_format($item->price, 2) }}</td>
            <td class="px-4 py-3 text-right text-white">{{ $item->quantity }}</td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('vendor.products.edit', ['sport'=>$sport, 'id'=>$item->id]) }}"
                 class="px-3 py-1.5 rounded bg-white/10 hover:bg-white/20">Edit</a>
              <form action="{{ route('vendor.products.destroy', ['sport'=>$sport, 'id'=>$item->id]) }}"
                    method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="px-3 py-1.5 rounded bg-red-600/70 hover:bg-red-600"
                        onclick="return confirm('Delete this item?')">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">No items yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ method_exists($items,'links') ? $items->links() : '' }}</div>
</div>
@endsection
