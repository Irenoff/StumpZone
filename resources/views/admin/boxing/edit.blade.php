@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 py-8 mx-auto bg-gradient-to-br from-red-50 via-white to-yellow-100">
    <div class="max-w-5xl p-8 mx-auto bg-white border-2 border-red-200 shadow-xl rounded-2xl">
        <h1 class="mb-6 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-gray-700">
            🥊 Edit Boxing Equipment
        </h1>

        <form action="{{ route('admin.boxing.update', $boxing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Name -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $boxing->name) }}"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                           required>
                </div>

                <!-- Type -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Type</label>
                    <input type="text" name="type" value="{{ old('type', $boxing->type) }}"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="e.g. Gloves, Pads, etc.">
                </div>

                <!-- Price -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $boxing->price) }}"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                           required>
                </div>

                <!-- Quantity -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Stock Quantity</label>
                    <input type="number" name="quantity" min="0" value="{{ old('quantity', $boxing->quantity) }}"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                           required>
                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Status</label>
                    <select name="status"
                            class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400">
                        <option value="available" {{ $boxing->status === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="out_of_stock" {{ $boxing->status === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="pre_order" {{ $boxing->status === 'pre_order' ? 'selected' : '' }}>Pre-order</option>
                    </select>
                </div>

                <!-- Size -->
                <div>
                    <label class="block mb-1 font-semibold text-red-700">Size</label>
                    <input type="text" name="size" value="{{ old('size', $boxing->size) }}"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                           placeholder="e.g. L, M, 12oz">
                </div>

                <!-- Image -->
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold text-red-700">Upload New Image</label>
                    <input type="file" name="image"
                           class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400">

                    @if($boxing->image_path)
                        <div class="mt-4">
                            <p class="mb-1 font-medium text-red-600">Current Image:</p>
                            <img src="{{ asset('storage/' . $boxing->image_path) }}" class="object-cover w-32 h-32 border rounded-md">
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block mb-1 font-semibold text-red-700">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full p-3 border-2 border-red-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400"
                              required>{{ old('description', $boxing->description) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.boxing.dashboard') }}"
                   class="px-6 py-3 font-medium text-gray-700 transition-all transform border-2 border-red-400 rounded-xl hover:bg-red-50 hover:scale-105 active:scale-95">
                    Back
                </a>
                <button type="submit"
                        class="px-6 py-3 font-medium text-white transition-all transform shadow-lg rounded-xl bg-gradient-to-r from-red-600 to-gray-700 hover:shadow-xl hover:scale-105 active:scale-95">
                    Update Equipment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
