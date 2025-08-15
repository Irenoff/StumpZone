@extends('layouts.app')
@section('title', 'Add New Arrival')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white shadow-lg rounded-xl">
    <h1 class="mb-4 text-2xl font-bold">Add New Arrival</h1>

    {{-- Success flash --}}
    @if(session('status'))
        <div class="px-4 py-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="px-4 py-3 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.arrivals.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full p-2 border rounded-lg @error('title') border-red-400 @enderror" required>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold">Sport <span class="text-red-500">*</span></label>
                <select name="sport" class="w-full p-2 border rounded-lg @error('sport') border-red-400 @enderror" required>
                    <option value="">Select sport</option>
                    @foreach (['cricket','football','basketball','badminton','boxing'] as $sport)
                        <option value="{{ $sport }}" @selected(old('sport')===$sport)>{{ ucfirst($sport) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Price (₹) <span class="text-red-500">*</span></label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                       class="w-full p-2 border rounded-lg @error('price') border-red-400 @enderror" required>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold">Stock (qty)</label>
                <input type="number" name="stock" min="0" value="{{ old('stock') }}"
                       class="w-full p-2 border rounded-lg @error('stock') border-red-400 @enderror">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full p-2 border rounded-lg @error('status') border-red-400 @enderror" required>
                    <option value="active" @selected(old('status','active')==='active')>Active</option>
                    <option value="draft"  @selected(old('status')==='draft')>Draft</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" rows="4"
                      class="w-full p-2 border rounded-lg @error('description') border-red-400 @enderror"
                      placeholder="Write a short description...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Image</label>
            <input type="file" name="image"
                   class="w-full p-2 border rounded-lg @error('image') border-red-400 @enderror"
                   accept="image/png,image/jpeg,image/webp">
            <p class="mt-1 text-xs text-gray-600">PNG/JPG/WEBP up to 3 MB.</p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                Save Arrival
            </button>
            <a href="{{ route('admin.home') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border rounded-lg hover:bg-gray-200">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
