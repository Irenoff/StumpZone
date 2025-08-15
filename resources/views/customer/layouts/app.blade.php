<!DOCTYPE html>
<html lang="en" class="h-full" x-data="{ sidebarOpen:false }" x-cloak>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'StumpZone')</title>

    {{-- Tailwind + JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak]{display:none!important}
        @keyframes float { 0%{transform:translateY(0)} 50%{transform:translateY(-10px)} 100%{transform:translateY(0)} }
        .float-slow{ animation: float 10s ease-in-out infinite; }
    </style>

    @stack('styles')
</head>
<body class="relative h-full text-gray-100 bg-gray-950">
    {{-- Decorative background --}}
    <div aria-hidden="true" class="absolute inset-0 pointer-events-none -z-10">
        <div class="absolute rounded-full -top-20 -left-16 w-80 h-80 bg-blue-600/10 blur-3xl float-slow"></div>
        <div class="absolute bottom-0 right-0 rounded-full w-96 h-96 bg-pink-500/10 blur-3xl float-slow" style="animation-delay:-3s"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-slate-950 to-gray-900 opacity-80"></div>
    </div>

    {{-- Top navbar --}}
    <header class="fixed inset-x-0 top-0 z-50 border-b bg-gray-950/70 backdrop-blur border-white/10">
        @include('customer.partials.navbar')

        {{-- Mobile sidebar toggle --}}
        <div class="flex items-center justify-between px-4 py-2 md:hidden">
            <button @click="sidebarOpen = true"
                    class="inline-flex items-center gap-2 px-3 py-2 text-sm border rounded-lg border-white/10 bg-white/5 hover:bg-white/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                </svg>
                Menu
            </button>
            @yield('header-actions')
        </div>
    </header>

    <div class="flex min-h-screen pt-20">

        {{-- ================= SIDEBAR (desktop) ================= --}}
        <aside class="relative hidden border-r md:flex md:w-80 bg-gray-900/60 backdrop-blur-xl border-white/10">
            <div class="absolute inset-y-0 left-0 w-[3px] bg-gradient-to-b from-cyan-400 via-blue-500 to-indigo-500"></div>

            <div class="flex flex-col w-full">
                {{-- Brand strip --}}
                <div class="flex items-center h-16 px-6 border-b border-white/10">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold tracking-wide">
                        <span class="inline-block h-2 w-2 rounded-full bg-cyan-400 shadow-[0_0_20px] shadow-cyan-400/50"></span>
                        StumpZone
                    </a>
                </div>

                {{-- Search --}}
                <form action="{{ route('customer.search') }}" method="GET" class="px-4 py-3 border-b border-white/10">
                    <div class="flex items-center gap-2 px-3 py-2 border rounded-xl bg-white/5 border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.3 6.3a7.5 7.5 0 0 0 10.35 10.35Z"/>
                        </svg>
                        <input name="query" type="text" placeholder="Search equipment…"
                               class="w-full text-sm placeholder-gray-400 bg-transparent outline-none">
                    </div>
                </form>

                {{-- Nav + buttons --}}
                <div class="flex-1 p-3 space-y-4 overflow-y-auto">
                    {{-- Sports --}}
                    <div>
                        <p class="px-3 mb-2 text-xs font-semibold tracking-wider text-gray-400/80">SPORTS CATEGORIES</p>

                        @php
                            $linkBase = 'flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 hover:bg-white/5 group';
                            $active   = 'bg-gradient-to-r from-blue-900/30 to-indigo-900/30 border border-white/5 shadow-lg shadow-blue-500/10';
                        @endphp

                        <div class="space-y-1">
                            <a href="{{ url('/shop/sport/cricket') }}"
                               class="{{ $linkBase }} {{ request()->is('shop/sport/cricket') ? $active : '' }}">
                                <span class="p-1.5 rounded-lg bg-amber-500/10 text-amber-400 group-hover:bg-amber-500/20 transition-colors duration-200">
                                    🏏
                                </span>
                                <span>Cricket</span>
                            </a>

                            <a href="{{ url('/shop/sport/football') }}"
                               class="{{ $linkBase }} {{ request()->is('shop/sport/football') ? $active : '' }}">
                                <span class="p-1.5 rounded-lg bg-emerald-500/10 text-emerald-400 group-hover:bg-emerald-500/20">⚽</span>
                                <span>Football</span>
                            </a>

                            <a href="{{ url('/shop/sport/basketball') }}"
                               class="{{ $linkBase }} {{ request()->is('shop/sport/basketball') ? $active : '' }}">
                                <span class="p-1.5 rounded-lg bg-orange-500/10 text-orange-400 group-hover:bg-orange-500/20">🏀</span>
                                <span>Basketball</span>
                            </a>

                            <a href="{{ url('/shop/sport/badminton') }}"
                               class="{{ $linkBase }} {{ request()->is('shop/sport/badminton') ? $active : '' }}">
                                <span class="p-1.5 rounded-lg bg-cyan-500/10 text-cyan-400 group-hover:bg-cyan-500/20">🏸</span>
                                <span>Badminton</span>
                            </a>

                            <a href="{{ url('/shop/sport/boxing') }}"
                               class="{{ $linkBase }} {{ request()->is('shop/sport/boxing') ? $active : '' }}">
                                <span class="p-1.5 rounded-lg bg-rose-500/10 text-rose-400 group-hover:bg-rose-500/20">🥊</span>
                                <span>Boxing</span>
                            </a>
                        </div>
                    </div>

                    {{-- ===== New Offers photo button ===== --}}
                    <div class="pt-4 border-t border-white/10">
                        <a href="{{ url('/offers') }}"
                           class="relative block overflow-hidden transition transform shadow-lg group rounded-xl hover:shadow-pink-500/40 hover:-translate-y-1">
                            <img src="{{ asset('build/assets/Screenshot 2025-08-08 140238.png') }}"
                                 alt="New Offers"
                                 class="object-cover w-full transition h-28 group-hover:opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <span class="absolute text-sm font-semibold tracking-wide text-white bottom-2 left-3">🎁 New Arrivals</span>
                        </a>
                    </div>

                    {{-- ===== Reviews text button (no image) ===== --}}
                    <div class="pt-2">
                        <a href="{{ url('/reviews') }}"
                           class="block px-3 py-3 text-sm font-semibold text-white transition rounded-lg bg-white/5 hover:bg-white/10">
                            ⭐ Customer Reviews
                        </a>
                    </div>

                    {{-- Account --}}
                    <div class="pt-4 border-t border-white/10">
                        <p class="px-3 mb-2 text-xs font-semibold tracking-wider text-gray-400/80">ACCOUNT</p>

                        {{-- NEW: My Orders button --}}
                        <a href="{{ route('customer.orders.index') }}"
                           class="block px-3 py-2 mb-1 transition rounded-lg hover:bg-white/5 {{ request()->is('orders') ? 'bg-white/5' : '' }}">
                            🧾 My Orders
                        </a>

                        <a href="{{ url('/profile') }}" class="block px-3 py-2 transition rounded-lg hover:bg-white/5">
                            👤 Profile
                        </a>
                    </div>
                </div>

                {{-- Sidebar footer --}}
                <div class="p-4 text-xs text-gray-400 border-t border-white/10">
                    <div class="flex items-center justify-between">
                        <span>© {{ date('Y') }} StumpZone</span>
                        <span class="inline-flex items-center gap-1 text-gray-300/70">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_10px] shadow-emerald-400/50"></span>
                            Live
                        </span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ================= MOBILE SIDEBAR (slide-in) ================= --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-50 md:hidden">
            <div @click="sidebarOpen=false" class="absolute inset-0 bg-black/60"></div>
            <aside class="absolute top-0 left-0 h-full p-4 border-r w-80 bg-gray-900/95 backdrop-blur-xl border-white/10"
                   x-transition:enter="transition ease-out duration-200"
                   x-transition:enter-start="-translate-x-full"
                   x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in duration-150"
                   x-transition:leave-start="translate-x-0"
                   x-transition:leave-end="-translate-x-full">
                <div class="flex items-center justify-between h-12 mb-2">
                    <a href="{{ url('/') }}" class="font-semibold tracking-wide">StumpZone</a>
                    <button @click="sidebarOpen=false" class="p-2 rounded-lg hover:bg-white/5">✕</button>
                </div>

                <div class="mb-4 space-y-1">
                    <a href="{{ url('/shop/sport/cricket') }}"    class="block px-3 py-2 rounded-lg hover:bg-white/5 {{ request()->is('shop/sport/cricket') ? 'bg-white/5' : '' }}">Cricket</a>
                    <a href="{{ url('/shop/sport/football') }}"   class="block px-3 py-2 rounded-lg hover:bg-white/5 {{ request()->is('shop/sport/football') ? 'bg-white/5' : '' }}">Football</a>
                    <a href="{{ url('/shop/sport/basketball') }}" class="block px-3 py-2 rounded-lg hover:bg-white/5 {{ request()->is('shop/sport/basketball') ? 'bg-white/5' : '' }}">Basketball</a>
                    <a href="{{ url('/shop/sport/badminton') }}"  class="block px-3 py-2 rounded-lg hover:bg-white/5 {{ request()->is('shop/sport/badminton') ? 'bg-white/5' : '' }}">Badminton</a>
                    <a href="{{ url('/shop/sport/boxing') }}"     class="block px-3 py-2 rounded-lg hover:bg-white/5 {{ request()->is('shop/sport/boxing') ? 'bg-white/5' : '' }}">Boxing</a>
                </div>

                {{-- Offers image button --}}
                <div class="pt-3">
                    <a href="{{ url('/offers') }}"
                       class="relative block overflow-hidden transition transform shadow-lg group rounded-xl hover:shadow-pink-500/40 hover:-translate-y-1">
                        <img src="{{ asset('build/assets/Screenshot 2025-08-08 140238.png') }}" alt="New Offers"
                             class="object-cover w-full h-24 transition group-hover:opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute text-sm font-semibold text-white bottom-2 left-3">🎁 New Offers</span>
                    </a>
                </div>

                {{-- Reviews text button --}}
                <div class="pt-3">
                    <a href="{{ url('/reviews') }}"
                       class="block px-3 py-3 text-sm font-semibold text-white transition rounded-lg bg-white/5 hover:bg-white/10">
                        ⭐ Customer Reviews
                    </a>
                </div>

                <div class="pt-3 mt-2 border-t border-white/10">
                    {{-- NEW: My Orders (mobile) --}}
                    <a href="{{ route('customer.orders.index') }}" class="block px-3 py-2 mb-1 rounded-lg hover:bg-white/5 {{ request()->is('orders') ? 'bg-white/5' : '' }}">🧾 My Orders</a>

                    <a href="{{ url('/profile') }}" class="block px-3 py-2 rounded-lg hover:bg-white/5">Profile</a>
                </div>
            </aside>
        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 min-w-0">
            @hasSection('page-toolbar')
                <div class="sticky z-10 hidden border-b md:block top-20 bg-gray-950/60 backdrop-blur border-white/10">
                    <div class="px-4 py-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        @yield('page-toolbar')
                    </div>
                </div>
            @endif

            <div class="w-full px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="py-8 space-y-10">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @includeIf('customer.partials.footer')
    @stack('scripts')
</body>
</html>
