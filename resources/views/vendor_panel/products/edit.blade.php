@extends('vendor_panel.layouts.app')
@section('title', "Edit • $sportLabel")

@section('content')
<div class="max-w-xl px-4 py-8 mx-auto">
  <h1 class="mb-6 text-2xl font-bold text-white">{{ $sportLabel }} • Edit Item</h1>

  <form method="POST" enctype="multipart/form-data"
        action="{{ route('vendor.products.update', ['sport'=>$sport, 'id'=>$item->id]) }}"
        class="p-5 space-y-4 border rounded-xl bg-white/5 border-white/10">
    @csrf @method('PUT')

    <div>
      <label class="block mb-1 text-sm text-gray-300">Name</label>
      <input name="name" value="{{ old('name',$item->name) }}" required
             class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Price</label>
      <input type="number" step="0.01" min="0" name="price" value="{{ old('price',$item->price) }}" required
             class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Quantity</label>
      <input type="number" min="0" name="quantity" value="{{ old('quantity',$item->quantity) }}" required
             class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Status</label>
      <select name="status" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        <option value="available"   @selected(($item->status ?? 'available')==='available')>Available</option>
        <option value="out_of_stock"@selected(($item->status ?? '')==='out_of_stock')>Out of Stock</option>
        <option value="pre_order"   @selected(($item->status ?? '')==='pre_order')>Pre-order</option>
      </select>
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Image</label>
      @if($item->image_path)
        <div class="mb-2">
          <img src="{{ asset('storage/'.$item->image_path) }}" class="object-cover w-24 h-24 rounded">
        </div>
      @endif
      <input type="file" name="image" accept="image/*"
             class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Description</label>
      <textarea name="description" rows="3" required
                class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">{{ old('description',$item->description) }}</textarea>
    </div>

    <div class="flex items-center gap-2 pt-2">
      <a href="{{ route('vendor.products.index',['sport'=>$sport]) }}"
         class="px-4 py-2 border rounded-lg bg-white/10 border-white/10 hover:bg-white/20">Cancel</a>
      <button class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700">Save Changes</button>
    </div>
  </form>
</div>
@endsection
