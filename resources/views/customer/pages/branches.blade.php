@extends('layouts.app')

@section('title', 'Branches – StumpZone')

@section('content')
<div class="min-h-screen overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100">

  {{-- Floating gradient orbs --}}
  <div class="fixed -top-1/4 -left-1/4 w-[80vw] h-[80vw] rounded-full bg-gradient-to-br from-amber-500/10 to-transparent blur-[100px] animate-float-1"></div>
  <div class="fixed -bottom-1/4 -right-1/4 w-[60vw] h-[60vw] rounded-full bg-gradient-to-br from-fuchsia-500/10 to-transparent blur-[100px] animate-float-2"></div>

  {{-- Hero section --}}
  <div class="relative px-6 pt-16 pb-12 mx-auto text-center max-w-7xl">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
      <div class="w-[300px] h-[300px] rounded-full bg-gradient-to-r from-amber-400/5 via-orange-400/5 to-pink-500/5 blur-[80px]"></div>
    </div>

    {{-- FIXED: render “Our Branches” on one line with separate gradients and a light underline --}}
    <h1 class="relative flex items-end justify-center gap-3 text-5xl font-bold tracking-tight md:text-6xl">
      <span class="text-transparent bg-gradient-to-r from-amber-300 via-orange-300 to-pink-400 bg-clip-text">Our</span>

      <span class="relative inline-block">
        <span class="relative z-10 text-transparent bg-gradient-to-r from-amber-300 via-orange-300 to-pink-400 bg-clip-text">
          Branches
        </span>
        <svg
          class="absolute left-0 right-0 w-full h-4 pointer-events-none -bottom-2 text-amber-200/60"
          viewBox="0 0 200 20" aria-hidden="true">
          <path d="M0,10 Q50,5 100,10 T200,10" stroke="currentColor" fill="none" stroke-width="2"/>
        </svg>
      </span>
    </h1>

    <p class="relative max-w-2xl mx-auto mt-4 text-lg leading-relaxed md:text-xl text-slate-300/90">
      Experience cricket excellence at our premium locations across Sri Lanka. Our expert staff awaits to elevate your game.
    </p>
  </div>

  <div class="relative px-6 pb-20 mx-auto max-w-7xl">
    {{-- Branch cards --}}
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      @php
        $branches = [
          [
            'name' => 'Colombo',
            'img' => 'build\assets\R.jpg',
            'address' => '123 Galle Road, Colombo 03',
            'phone' => '+94 11 234 5678',
            'hours' => ['Mon–Fri: 9AM–6PM', 'Sat: 9AM–4PM', 'Sun: Closed'],
            'features' => ['Pro batting cages', 'Equipment fitting', 'Coaching sessions'],
            'color' => 'bg-gradient-to-br from-amber-500 to-orange-600'
          ],
          [
            'name' => 'Kandy',
            'img' => 'build\assets\Shopping-in-Colombo-1240x698.jpg',
            'address' => '45 Temple Street, Kandy',
            'phone' => '+94 81 234 5678',
            'hours' => ['Mon–Fri: 9AM–6PM', 'Sat: 9AM–4PM', 'Sun: Closed'],
            'features' => ['Indoor nets', 'Video analysis', 'Player lounge' ,'Bat lockers'],
            'color' => 'bg-gradient-to-br from-emerald-500 to-cyan-600'
          ],
          [
            'name' => 'Galle',
            'img' => 'build\assets\3105131_sportsdirectmanchesterflagship4_792132.jpg',
            'address' => '78 Lighthouse Street, Galle Fort',
            'phone' => '+94 91 234 5678',
            'hours' => ['Mon–Fri: 9AM–6PM', 'Sat: 9AM–4PM', 'Sun: 10AM–2PM'],
            'features' => ['Beachside location', 'Bat repair', 'Pro shop','Gear up'],
            'color' => 'bg-gradient-to-br from-violet-500 to-fuchsia-600'
          ],
        ];
      @endphp

      @foreach ($branches as $branch)
        <div id="{{ Str::slug($branch['name']) }}" class="relative h-full overflow-hidden transition-all duration-300 border group rounded-2xl border-white/10 bg-white/5 backdrop-blur-md hover:-translate-y-1 hover:shadow-xl">
          {{-- Glow effect on hover --}}
          <div class="absolute inset-0 transition-opacity duration-500 opacity-0 group-hover:opacity-100">
            <div class="absolute -inset-1 rounded-xl bg-gradient-to-r from-amber-400/30 via-orange-500/30 to-pink-500/30 blur-md"></div>
          </div>

          {{-- Image header --}}
          <div class="relative aspect-[16/9] overflow-hidden">
            <img src="{{ $branch['img'] }}" alt="{{ $branch['name'] }}"
                 class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-105" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-5">
              <div class="flex items-center justify-between">
                <h3 class="text-2xl font-bold text-white">{{ $branch['name'] }}</h3>
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $branch['color'] }} text-white shadow-md">
                  Open Today
                </span>
              </div>
            </div>
          </div>

          {{-- Branch details --}}
          <div class="p-5 space-y-4">
            <div class="flex items-start gap-3">
              <div class="flex-shrink-0 p-2 rounded-lg {{ $branch['color'] }} text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <p class="text-slate-200">{{ $branch['address'] }}</p>
            </div>

            <div class="flex items-start gap-3">
              <div class="flex-shrink-0 p-2 rounded-lg {{ $branch['color'] }} text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
              </div>
              <p class="text-slate-200">{{ $branch['phone'] }}</p>
            </div>

            <div class="flex items-start gap-3">
              <div class="flex-shrink-0 p-2 rounded-lg {{ $branch['color'] }} text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <div class="space-y-1">
                @foreach ($branch['hours'] as $hour)
                  <p class="text-slate-200">{{ $hour }}</p>
                @endforeach
              </div>
            </div>

            {{-- Features --}}
            <div class="pt-2">
              <h4 class="mb-2 text-sm font-semibold text-slate-300">BRANCH FEATURES</h4>
              <div class="flex flex-wrap gap-2">
                @foreach ($branch['features'] as $feature)
                  <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-white/5 text-slate-200 border border-white/10">
                    {{ $feature }}
                  </span>
                @endforeach
              </div>
            </div>

            {{-- CTA buttons --}}
            <div class="flex gap-3 pt-4">
              <a href="tel:{{ preg_replace('/\s+/', '', $branch['phone']) }}"
                 class="flex-1 px-4 py-2.5 text-sm font-semibold text-center text-white transition rounded-lg {{ $branch['color'] }} hover:brightness-110 shadow-md">
                Call Branch
              </a>
              <a href="#map"
                 class="flex-1 px-4 py-2.5 text-sm font-semibold text-center text-white transition rounded-lg border border-white/15 bg-white/5 hover:bg-white/10">
                View Map
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Interactive map section --}}
    <div id="map" class="relative mt-16 overflow-hidden border rounded-2xl border-white/10 bg-gradient-to-br from-slate-900 to-slate-950">
      <div class="absolute inset-0 bg-gradient-to-r from-amber-400/10 via-orange-500/10 to-pink-500/10"></div>
      <div class="relative p-8">
        <div class="max-w-2xl">
          <h2 class="text-3xl font-bold tracking-tight text-transparent bg-gradient-to-r from-amber-300 to-pink-400 bg-clip-text">
            Find Your Nearest StumpZone
          </h2>
          <p class="mt-2 text-slate-300/90">
            All our branches are conveniently located with ample parking and easy access.
            Hover over the map to see locations or use our branch locator.
          </p>
        </div>

        <div class="mt-8 overflow-hidden shadow-2xl rounded-xl ring-1 ring-white/10">
          <div class="aspect-[16/9] w-full bg-slate-800/50 relative">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1012083.8912704897!2d79.86124300000001!3d7.873054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2593cf65a1e9d%3A0xe13da4b400e2d38c!2sSri%20Lanka!5e0!3m2!1sen!2sus!4v1684323456789!5m2!1sen!2sus"
              width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-slate-950/30 to-transparent"></div>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
          @foreach ($branches as $branch)
            <div class="p-4 transition-colors border rounded-lg border-white/10 bg-white/5 backdrop-blur-sm hover:bg-white/10">
              <h4 class="flex items-center gap-2 font-semibold text-white">
                <span class="w-2 h-2 rounded-full
                  {{ str_contains($branch['color'], 'amber') ? 'bg-amber-400' : '' }}
                  {{ str_contains($branch['color'], 'emerald') ? 'bg-emerald-400' : '' }}
                  {{ str_contains($branch['color'], 'violet') ? 'bg-violet-400' : '' }}"></span>
                {{ $branch['name'] }}
              </h4>
              <p class="mt-1 text-sm text-slate-300">{{ $branch['address'] }}</p>
              <a href="#{{ Str::slug($branch['name']) }}" class="inline-block mt-2 text-sm font-medium transition-colors text-amber-400 hover:text-amber-300">
                View details →
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Animations --}}
<style>
  @keyframes float { 0%,100%{transform:translateY(0) rotate(0)} 50%{transform:translateY(-20px) rotate(2deg)} }
  .animate-float-1{animation:float 8s ease-in-out infinite}
  .animate-float-2{animation:float 10s ease-in-out infinite reverse}
</style>
@endsection
