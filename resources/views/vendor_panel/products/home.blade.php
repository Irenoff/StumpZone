@extends('vendor_panel.layouts.app')
@section('title','Vendor • Manage Products')

@section('content')
<div class="max-w-5xl px-4 py-10 mx-auto">
  <h1 class="mb-6 text-2xl font-bold text-white">Manage Products</h1>

  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.products.index',['sport'=>'cricket']) }}">🏏 Cricket</a>

    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.products.index',['sport'=>'football']) }}">⚽ Football</a>

    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.products.index',['sport'=>'basketball']) }}">🏀 Basketball</a>

    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.products.index',['sport'=>'badminton']) }}">🏸 Badminton</a>

    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.products.index',['sport'=>'boxing']) }}">🥊 Boxing</a>

    {{-- New Arrivals --}}
    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.arrivals.index') }}">🆕 New Arrivals</a>

    {{-- ⭐ View Reviews (NEW) --}}
    <a class="p-6 transition border rounded-xl bg-white/5 border-white/10 hover:bg-white/10"
       href="{{ route('vendor.reviews.index') }}">⭐ View Reviews</a>
  </div>
</div>
@endsection
