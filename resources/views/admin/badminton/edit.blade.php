@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="min-h-screen px-4 py-8 mx-auto bg-gradient-to-br from-orange-50 via-blue-50 to-yellow-50">
    <div class="max-w-5xl p-8 mx-auto bg-white shadow-xl rounded-2xl">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-blue-600">
                � Edit Badminton Equipment
            </h1>
            <a href="{{ route('admin.badminton.dashboard') }}" 
               class="px-6 py-2 font-medium text-orange-700 transition-all transform bg-orange-100 rounded-full hover:bg-orange-200 hover:scale-105 active:scale-95">
                Back to Inventory
            </a>
        </div>

        <form action="{{ route('admin.badminton.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Name Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ $item->name }}" required 
                           class="w-full px-4 py-3 placeholder-orange-300 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                           placeholder="e.g. Badminton Racket">
                </div>
                
                <!-- Type Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Type <span class="text-rose-500">*</span></label>
                    <select name="type" required
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="rackets" {{ $item->type == 'rackets' ? 'selected' : '' }}>Rackets</option>
                        <option value="shuttles" {{ $item->type == 'shuttles' ? 'selected' : '' }}>Shuttles</option>
                        <option value="shoes" {{ $item->type == 'shoes' ? 'selected' : '' }}>Shoes</option>
                        <option value="nets" {{ $item->type == 'nets' ? 'selected' : '' }}>Nets</option>
                        <option value="accessories" {{ $item->type == 'accessories' ? 'selected' : '' }}>Accessories</option>
                    </select>
                </div>
                
                <!-- Price Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Price ($) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute text-orange-400 left-3 top-3">$</span>
                        <input type="number" name="price" step="0.01" min="0.01" value="{{ $item->price }}" required 
                               class="w-full py-3 pl-8 pr-4 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                               placeholder="0.00">
                    </div>
                </div>
                
                <!-- Image Upload -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-orange-700">Current Image</label>
                    <div class="flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <div class="relative flex-shrink-0 w-32 h-32 overflow-hidden border-2 border-orange-200 rounded-xl">
                            <img id="imagePreview" src="{{ $item->image_url }}" 
                                 class="object-cover w-full h-full">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-orange-700">Change Image</label>
                            <input type="file" name="image" id="imageInput" accept="image/*" 
                                   class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl file:bg-orange-100 file:text-orange-700 file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-4">
                        </div>
                    </div>
                </div>
                
                <!-- Description Field -->
                <div class="space-y-2 md:col-span-3">
                    <label class="block text-sm font-medium text-orange-700">Description <span class="text-rose-500">*</span></label>
                    <textarea name="description" rows="4" required 
                              class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                              placeholder="Describe the product features...">{{ $item->description }}</textarea>
                </div>
                
                <!-- Stock Quantity -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Stock Quantity <span class="text-rose-500">*</span></label>
                    <input type="number" name="quantity" min="0" value="{{ $item->quantity }}" required 
                           class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                           placeholder="0">
                </div>
                
                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Status</label>
                    <select name="status" 
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="out_of_stock" {{ $item->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="pre_order" {{ $item->status == 'pre_order' ? 'selected' : '' }}>Pre-order</option>
                    </select>
                </div>
                
                <!-- Size -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Size</label>
                    <select name="size" 
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="">Select Size</option>
                        <option value="S" {{ $item->size == 'S' ? 'selected' : '' }}>Size S</option>
                        <option value="M" {{ $item->size == 'M' ? 'selected' : '' }}>Size M</option>
                        <option value="L" {{ $item->size == 'L' ? 'selected' : '' }}>Size L</option>
                        <option value="XL" {{ $item->size == 'XL' ? 'selected' : '' }}>Size XL</option>
                        <option value="3U" {{ $item->size == '3U' ? 'selected' : '' }}>3U (85-89g)</option>
                        <option value="4U" {{ $item->size == '4U' ? 'selected' : '' }}>4U (80-84g)</option>
                        <option value="5U" {{ $item->size == '5U' ? 'selected' : '' }}>5U (75-79g)</option>
                    </select>
                </div>
            </div>
            
            <div class="flex flex-wrap justify-end gap-4 mt-8">
                <button type="button" onclick="window.location.href='{{ route('admin.badminton.dashboard') }}'" 
                        class="px-8 py-3 font-medium text-orange-700 transition-all transform bg-orange-100 rounded-full hover:bg-orange-200 hover:scale-105 active:scale-95">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-8 py-3 font-medium text-white transition-all transform rounded-full shadow-lg bg-gradient-to-r from-orange-600 to-blue-600 hover:shadow-xl hover:scale-105 active:scale-95">
                    Update Equipment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview Functionality for Edit Page
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imagePreview').src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection