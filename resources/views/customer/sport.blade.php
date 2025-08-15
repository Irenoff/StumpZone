@extends('customer.layouts.app')

@section('content')
<h2 class="mb-4 text-2xl font-bold capitalize">{{ $sport }} Equipment</h2>

<div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    @forelse ($items as $item)
        <div class="p-4 bg-white rounded shadow">
            <img src="{{ asset('storage/' . $item->image_path) }}" class="object-cover w-full h-40 mb-2">
            <h3 class="font-bold">{{ $item->name }}</h3>
            <p class="text-sm">{{ $item->description }}</p>
            <p class="font-bold text-green-600">₹{{ $item->price }}</p>
        </div>
    @empty
        <p>No equipment found for {{ $sport }}.</p>
    @endforelse
</div>
@endsection
