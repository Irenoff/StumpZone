@extends('admin.layouts.app')
@section('title','Admin • Edit Arrival')

@section('content')
<div class="max-w-4xl px-4 py-10 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-white">Edit Arrival</h1>

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

    <div class="p-6 border rounded-xl bg-white/5 border-white/10">
        <form method="POST" action="{{ route('admin.arrivals.update', $item->id) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm text-slate-200">Title</label>
                <input name="title" value="{{ old('title', $item->title) }}" required
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Sport</label>
                <select name="sport" required class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10">
                    @php $sportOld = old('sport', $item->sport); @endphp
                    <option value="cricket"     @selected($sportOld==='cricket')>Cricket</option>
                    <option value="football"    @selected($sportOld==='football')>Football</option>
                    <option value="basketball"  @selected($sportOld==='basketball')>Basketball</option>
                    <option value="badminton"   @selected($sportOld==='badminton')>Badminton</option>
                    <option value="boxing"      @selected($sportOld==='boxing')>Boxing</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-sm text-slate-200">Description</label>
                <textarea name="description" rows="3" required
                          class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">{{ old('description', $item->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Price</label>
                <input type="number" name="price" step="0.01" min="0.01" value="{{ old('price', $item->price) }}" required
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Stock</label>
                <input type="number" name="stock" min="0" step="1" value="{{ old('stock', (int)($item->stock ?? 0)) }}"
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 placeholder-slate-400">
            </div>

            <div>
                <label class="block mb-1 text-sm text-slate-200">Status</label>
                <select name="status" class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10">
                    @php $statusOld = old('status', $item->status ?? 'available'); @endphp
                    <option value="available"    @selected($statusOld==='available')>Available</option>
                    <option value="out_of_stock" @selected($statusOld==='out_of_stock')>Out of Stock</option>
                    <option value="pre_order"    @selected($statusOld==='pre_order')>Pre-order</option>
                    <option value="active"       @selected($statusOld==='active')>Active</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-sm text-slate-200">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-3 py-2 text-white border rounded-lg bg-white/10 border-white/10 file:bg-white/10 file:border-0 file:mr-3">
                @if($item->image_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$item->image_path) }}" class="object-cover w-24 h-24 border rounded-md border-white/10" alt="">
                    </div>
                @endif
            </div>

            <div class="flex justify-end gap-3 md:col-span-2">
                <a href="{{ route('admin.arrivals.index') }}" class="px-4 py-2 text-white border rounded-lg bg-white/10 border-white/10 hover:bg-white/20">Cancel</a>
                <button type="submit" class="px-5 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
