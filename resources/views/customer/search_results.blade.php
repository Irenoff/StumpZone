@extends('customer.layouts.app')

@section('content')
    <div class="min-h-screen px-6 text-white pt-28 lg:px-16 bg-gradient-to-br from-gray-900 via-purple-900 to-gray-800">
        <h2 class="mb-6 text-3xl font-bold">
            Search Results for "<span class="text-pink-400">{{ $query }}</span>"
        </h2>

        @if($results->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($results as $item)
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 shadow-lg border border-white/20 hover:scale-[1.03] transition-all">
                        
                        {{-- Image --}}
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                 alt="{{ $item->name }}"
                                 class="object-cover w-full h-40 mb-3 rounded-md shadow">
                        @else
                            <div class="flex items-center justify-center w-full h-40 mb-3 bg-gray-700 rounded-md text-white/60">
                                No Image
                            </div>
                        @endif

                        {{-- Name --}}
                        <h3 class="text-lg font-semibold text-white">{{ $item->name }}</h3>

                        {{-- Optional description --}}
                        @if(isset($item->description))
                            <p class="text-sm text-white/70 line-clamp-2">{{ $item->description }}</p>
                        @endif

                        {{-- Optional price --}}
                        @if(isset($item->price))
                            <p class="mt-2 font-bold text-pink-400">Rs. {{ number_format($item->price, 2) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-6 text-lg text-white/80">No items found matching your search.</p>
        @endif
    </div>
@endsection
