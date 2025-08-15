@extends('customer.layouts.app')
@section('title', 'Vendor • Add Product')

@section('content')
<div class="max-w-3xl px-4 py-8 mx-auto">
  <h1 class="mb-6 text-2xl font-bold text-white">Add Product</h1>

  <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
      <label class="block mb-1 text-sm text-gray-300">Sport</label>
      <select name="sport" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
        @foreach($sports as $s)
          <option value="{{ $s }}" @selected($sport===$s)>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Name</label>
      <input name="name" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg" required>
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Size</label>
      <input name="size" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg" placeholder="N/A">
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block mb-1 text-sm text-gray-300">Price</label>
        <input name="price" type="number" step="0.01" min="0" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg" required>
      </div>
      <div>
        <label class="block mb-1 text-sm text-gray-300">Quantity</label>
        <input name="quantity" type="number" min="0" class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg" required>
      </div>
    </div>

    <div>
      <label class="block mb-1 text-sm text-gray-300">Image (optional)</label>
      <input name="image" type="file" class="w-full text-gray-300">
    </div>

    <div class="pt-2">
      <button class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700">Save</button>
      <a href="{{ route('vendor.products.index', ['sport'=>$sport]) }}" class="px-4 py-2 ml-2 border rounded-lg bg-white/10 border-white/10 hover:bg-white/20">Cancel</a>
    </div>
  </form>
</div>
@endsection
