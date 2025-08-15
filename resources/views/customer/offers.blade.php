@php use Illuminate\Support\Str; @endphp
@extends('customer.layouts.app')
@section('title', 'New Arrivals')

@section('page-toolbar')
  <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h1 class="text-lg font-semibold">🆕 New Arrivals</h1>

    <form method="GET" class="flex flex-wrap items-center gap-2">
      <select name="sport" class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10 text-sm">
        <option value="">All sports</option>
        @foreach (['cricket','football','basketball','badminton','boxing'] as $sport)
          <option value="{{ $sport }}" @selected(request('sport')===$sport)>{{ ucfirst($sport) }}</option>
        @endforeach
      </select>

      <input type="text" name="q" value="{{ request('q') }}" placeholder="Search arrivals..." class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10 text-sm w-48">

      <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-cyan-600 to-blue-600 text-sm">Apply</button>

      @if(request()->hasAny(['sport','q']) && (request('sport') || request('q')))
        <a href="{{ route('customer.arrivals') }}" class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-sm">Reset</a>
      @endif
    </form>
  </div>
@endsection

@section('content')
  <div class="relative overflow-hidden border rounded-2xl border-white/10 bg-white/5">
    <img src="{{ asset('build/assets/Screenshot 2025-08-08 140238.png') }}" class="object-cover w-full h-44 opacity-70" alt="New Arrivals">
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
    <div class="absolute bottom-4 left-4">
      <span class="inline-block px-2 py-1 text-xs font-bold tracking-wider text-white bg-pink-500 rounded-full">JUST IN</span>
      <h2 class="mt-2 text-2xl font-extrabold">Fresh Gear, Hot off the Truck</h2>
      <p class="text-sm text-gray-300">Latest arrivals across all sports</p>
    </div>
  </div>

  <div x-data="arrivalsPage()" class="relative">

    {{-- Grid --}}
    @if($arrivals->count())
      <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($arrivals as $item)
          @php
            $img = $item->image_path
              ? (Str::startsWith($item->image_path, ['http://','https://','/build/'])
                    ? $item->image_path
                    : asset('storage/'.$item->image_path))
              : asset('build/assets/Screenshot 2025-08-08 140238.png');

            $itemPayload = [
              'id'          => (int) $item->id,
              'title'       => (string) $item->title,
              'sport'       => (string) $item->sport,
              'sportLabel'  => ucfirst((string) $item->sport),
              'price'       => (float) $item->price,
              'priceLabel'  => 'LKR ' . number_format((float) $item->price, 2, '.', ','), // LKR
              'description' => (string) ($item->description ?? ''),
              'image'       => $img,
            ];
          @endphp

          <div class="p-4 transition border rounded-xl border-white/10 bg-white/5 hover:bg-white/10 group" x-data="{ item: @js($itemPayload) }">
            <div class="relative overflow-hidden">
              <img src="{{ $img }}" alt="{{ $item->title }}" class="object-cover w-full h-40 rounded-lg cursor-pointer" @click="showDetails(item)">
              @if($item->created_at && \Illuminate\Support\Carbon::parse($item->created_at)->gt(now()->subDays(7)))
                <span class="absolute px-2 py-0.5 text-[10px] font-bold top-2 left-2 rounded-full bg-emerald-500/90 text-white">NEW</span>
              @endif
              <span class="absolute px-2 py-0.5 text-[10px] font-bold top-2 right-2 rounded-full bg-white/10 border border-white/10">{{ ucfirst($item->sport) }}</span>
            </div>

            <div class="mt-3">
              <h3 class="font-semibold truncate cursor-pointer" title="{{ $item->title }}" @click="showDetails(item)">
                {{ $item->title }}
              </h3>

              <div class="flex items-center justify-between mt-3">
                <div class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                  LKR {{ number_format($item->price, 2) }}
                </div>

                @if(!is_null($item->stock))
                  <span class="px-2 py-0.5 text-xs rounded-full {{ $item->stock > 0 ? 'bg-emerald-500/15 text-emerald-300' : 'bg-rose-500/15 text-rose-300' }}">
                    {{ $item->stock > 0 ? $item->stock.' in stock' : 'Out of stock' }}
                  </span>
                @endif
              </div>
            </div>

            <div x-data="{ open:false }" class="relative mt-3">
              <button @click="open = !open" @keydown.escape.window="open=false" class="inline-flex items-center gap-2 px-3 py-1.5 text-xs rounded-lg bg-white/5 border border-white/10 hover:bg-white/10">
                Actions
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
              </button>

              <div x-show="open" x-transition.origin.top.right @click.away="open=false" class="absolute right-0 z-10 mt-2 overflow-hidden border rounded-md shadow-lg w-44 bg-gray-900/95 backdrop-blur border-white/10">
                <form method="POST" action="{{ route('cart.add') }}">
                  @csrf
                  <input type="hidden" name="equipment_id" value="{{ $item->id }}">
                  <input type="hidden" name="sport_type"   value="{{ $item->sport }}">
                  <input type="hidden" name="quantity"     value="1">
                  <button type="submit" class="w-full px-3 py-2 text-xs text-left hover:bg-white/10">Add to Cart</button>
                </form>
                <button type="button" @click="open=false; showDetails(item)" class="w-full px-3 py-2 text-xs text-left hover:bg-white/10">View Details</button>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-6">{{ $arrivals->links() }}</div>
    @else
      <div class="p-6 mt-8 text-center border rounded-xl border-white/10 bg-white/5">
        <p class="text-gray-400">No arrivals found. Try changing filters or check back soon.</p>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
<script>
  function arrivalsPage(){
    return {
      openModal: false,
      selectedItem: null,
      showDetails(item){ this.selectedItem = item; this.openModal = true; },
    }
  }
</script>
@endpush
