@extends('layouts.app')

@section('content')
<div class="max-w-xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h2 class="mb-6 text-2xl font-bold text-center text-blue-700">Edit Cricket Equipment</h2>

    <form action="{{ route('admin.cricket.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" value="{{ $item->name }}" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ $item->description }}</textarea>
        </div>

        <!-- Price -->
        <div>
            <label class="block mb-1 font-semibold">Price</label>
            <input type="number" step="0.01" name="price" value="{{ $item->price }}" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Quantity -->
        <div>
            <label class="block mb-1 font-semibold">Stock Quantity</label>
            <input type="number" name="quantity" min="0" value="{{ $item->quantity }}" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Status -->
        <div>
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="available" {{ $item->status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="out_of_stock" {{ $item->status === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                <option value="pre_order" {{ $item->status === 'pre_order' ? 'selected' : '' }}>Pre-order</option>
            </select>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block mb-1 font-semibold">Upload New Image (optional)</label>
            <input type="file" name="image" class="w-full p-2 border rounded">
        </div>

        <!-- Current Image -->
        @if($item->image_path)
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Current Image:</label>
                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-32 border rounded">
            </div>
        @endif

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit" class="w-full px-4 py-2 font-semibold text-white transition duration-200 rounded shadow-md bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800">
                Update Item
            </button>
        </div>
    </form>
</div>
@endsection
