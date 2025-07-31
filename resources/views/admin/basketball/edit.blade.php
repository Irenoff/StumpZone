@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 py-8 mx-auto bg-gradient-to-br from-orange-50 via-blue-50 to-yellow-50">
    <div class="max-w-5xl p-8 mx-auto bg-white border-2 border-orange-200 shadow-xl rounded-2xl">
        <h1 class="mb-6 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-blue-600">
            🏀 Edit Basketball Equipment
        </h1>
        
        <form action="{{ route('admin.basketball.update', $basketball->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Name Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $basketball->name) }}" required 
                           class="w-full px-4 py-3 placeholder-orange-300 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                           placeholder="e.g. Basketball Jersey">
                </div>
                
                <!-- Type Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Type <span class="text-rose-500">*</span></label>
                    <select name="type" required
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="balls" {{ old('type', $basketball->type) === 'balls' ? 'selected' : '' }}>Basketballs</option>
                        <option value="jerseys" {{ old('type', $basketball->type) === 'jerseys' ? 'selected' : '' }}>Jerseys</option>
                        <option value="shoes" {{ old('type', $basketball->type) === 'shoes' ? 'selected' : '' }}>Shoes</option>
                        <option value="accessories" {{ old('type', $basketball->type) === 'accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="training" {{ old('type', $basketball->type) === 'training' ? 'selected' : '' }}>Training Equipment</option>
                    </select>
                </div>
                
                <!-- Price Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Price ($) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute text-orange-400 left-3 top-3">$</span>
                        <input type="number" name="price" step="0.01" min="0.01" value="{{ old('price', $basketball->price) }}" required 
                               class="w-full py-3 pl-8 pr-4 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                               placeholder="0.00">
                    </div>
                </div>
                
                <!-- Stock Quantity -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Stock Quantity <span class="text-rose-500">*</span></label>
                    <input type="number" name="quantity" min="0" value="{{ old('quantity', $basketball->quantity) }}" required 
                           class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                           placeholder="0">
                </div>
                
                <!-- Status -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Status</label>
                    <select name="status" 
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="available" {{ old('status', $basketball->status) === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="out_of_stock" {{ old('status', $basketball->status) === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="pre_order" {{ old('status', $basketball->status) === 'pre_order' ? 'selected' : '' }}>Pre-order</option>
                    </select>
                </div>
                
                <!-- Size -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-orange-700">Size</label>
                    <select name="size" 
                            class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                        <option value="">Select Size</option>
                        <option value="S" {{ old('size', $basketball->size) === 'S' ? 'selected' : '' }}>Size S</option>
                        <option value="M" {{ old('size', $basketball->size) === 'M' ? 'selected' : '' }}>Size M</option>
                        <option value="L" {{ old('size', $basketball->size) === 'L' ? 'selected' : '' }}>Size L</option>
                        <option value="XL" {{ old('size', $basketball->size) === 'XL' ? 'selected' : '' }}>Size XL</option>
                        <option value="XXL" {{ old('size', $basketball->size) === 'XXL' ? 'selected' : '' }}>Size XXL</option>
                        <option value="5" {{ old('size', $basketball->size) === '5' ? 'selected' : '' }}>Size 5 (Ball)</option>
                        <option value="6" {{ old('size', $basketball->size) === '6' ? 'selected' : '' }}>Size 6 (Ball)</option>
                        <option value="7" {{ old('size', $basketball->size) === '7' ? 'selected' : '' }}>Size 7 (Ball)</option>
                    </select>
                </div>
              
                
                <!-- Image Upload and Preview -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-orange-700">Image</label>
                    <div class="flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <div class="relative flex-shrink-0 w-32 h-32 overflow-hidden border-2 border-orange-200 rounded-xl">
                            <img id="imagePreview" src="{{ $basketball->image_url }}" 
                                 class="object-cover w-full h-full">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="image" id="imageInput" accept="image/*" 
                                   class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl file:bg-orange-100 file:text-orange-700 file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-4">
                            <p class="mt-1 text-xs text-orange-500">Leave blank to keep current image</p>
                        </div>
                    </div>
                </div>
                
                <!-- Description Field -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-medium text-orange-700">Description <span class="text-rose-500">*</span></label>
                    <textarea name="description" rows="4" required 
                              class="w-full px-4 py-3 transition-all border-2 border-orange-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent"
                              placeholder="Describe the product features...">{{ old('description', $basketball->description) }}</textarea>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.basketball.dashboard') }}" 
                   class="px-6 py-3 font-medium text-orange-700 transition-all transform bg-orange-100 rounded-xl hover:bg-orange-200 hover:scale-105 active:scale-95">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 font-medium text-white transition-all transform shadow-lg rounded-xl bg-gradient-to-r from-orange-600 to-blue-600 hover:shadow-xl hover:scale-105 active:scale-95">
                    Update Equipment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview Functionality for Edit Form
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