@extends('layouts.app')

@section('content')
<div class="max-w-3xl py-10 mx-auto sm:px-6 lg:px-8">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Edit Football Equipment</h2>

    <form action="{{ route('admin.football.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ $item->name }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ $item->description }}</textarea>
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" value="{{ $item->price }}" step="0.01" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="0" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="out_of_stock" {{ $item->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="pre_order" {{ $item->status == 'pre_order' ? 'selected' : '' }}>Pre-order</option>
                </select>
            </div>

            <!-- Size -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Size</label>
                <select name="size" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="">-- Select Size --</option>
                    <option value="S" {{ $item->size == 'S' ? 'selected' : '' }}>Size S</option>
                    <option value="M" {{ $item->size == 'M' ? 'selected' : '' }}>Size M</option>
                    <option value="L" {{ $item->size == 'L' ? 'selected' : '' }}>Size L</option>
                    <option value="XL" {{ $item->size == 'XL' ? 'selected' : '' }}>Size XL</option>
                    <option value="5" {{ $item->size == '5' ? 'selected' : '' }}>Size 5 (Ball)</option>
                    <option value="4" {{ $item->size == '4' ? 'selected' : '' }}>Size 4 (Ball)</option>
                </select>
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload New Image (optional)</label>
                <input type="file" name="image" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @if ($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="w-32 h-32 mt-4 border rounded">
                @endif
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('admin.football.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 font-bold text-white bg-green-600 rounded-md hover:bg-green-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
