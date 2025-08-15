<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Vendor Panel')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    :root {
      --primary: 16 185 129;
      --secondary: 59 130 246;
    }
    
    .bg-dashboard {
      background-color: #0f172a;
      background-image: 
        radial-gradient(at 80% 0%, hsla(189,100%,56%,0.15) 0px, transparent 50%),
        radial-gradient(at 0% 50%, hsla(355,100%,93%,0.15) 0px, transparent 50%);
    }
    
    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }
    
    .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, rgba(59,130,246,1) 0%, rgba(16,185,129,1) 100%);
      border-radius: 2px;
    }
    
    .sidebar-item.active {
      background: rgba(255,255,255,0.05);
      border-left: 3px solid rgb(var(--primary));
    }
    
    .card-gradient {
      background: linear-gradient(135deg, rgba(30,41,59,0.5) 0%, rgba(15,23,42,0.7) 100%);
      backdrop-filter: blur(10px);
    }
  </style>
  @stack('head')
</head>
<body class="min-h-screen font-sans antialiased bg-dashboard text-slate-100">
  <!-- Sidebar + Main Content Layout -->
  <div class="flex">
    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-slate-800/50 bg-slate-900/50 backdrop-blur-md md:block">
      <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4 border-b border-slate-800/50">
          <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-2">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-cyan-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
              </svg>
            </div>
            <span class="text-xl font-semibold tracking-tight">Vendor</span>
          </a>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
          <a href="{{ route('vendor.dashboard') }}" 
             class="flex items-center px-4 py-3 text-sm rounded-lg sidebar-item {{ request()->routeIs('vendor.dashboard') ? 'active' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
          </a>
          
          <a href="{{ route('vendor.products.home') }}" 
             class="flex items-center px-4 py-3 text-sm rounded-lg sidebar-item {{ request()->routeIs('vendor.products.*') ? 'active' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products
          </a>
          
          <a href="{{ route('vendor.orders.index') }}" 
             class="flex items-center px-4 py-3 text-sm rounded-lg sidebar-item {{ request()->routeIs('vendor.orders.*') ? 'active' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Orders
          </a>
          
          <a href="{{ route('vendor.arrivals.index') }}" 
             class="flex items-center px-4 py-3 text-sm rounded-lg sidebar-item {{ request()->routeIs('vendor.arrivals.*') ? 'active' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Arrivals
          </a>
          
          <a href="{{ route('vendor.reviews.index') }}" 
             class="flex items-center px-4 py-3 text-sm rounded-lg sidebar-item {{ request()->routeIs('vendor.reviews.*') ? 'active' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            Reviews
          </a>
        </nav>
        
        <!-- User Profile -->
        <div class="p-4 border-t border-slate-800/50">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="relative">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-emerald-500"></div>
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 rounded-full border-slate-900"></span>
              </div>
              <div>
                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400">Vendor Account</p>
              </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="p-2 rounded-full text-slate-400 hover:text-white hover:bg-slate-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 md:ml-64">
      <!-- Mobile Header -->
      <header class="sticky top-0 z-30 flex items-center justify-between h-16 px-4 border-b border-slate-800/50 bg-slate-900/80 backdrop-blur-md md:hidden">
        <button @click="sidebarOpen = true" class="p-2 -ml-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        
        <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-2">
          <span class="text-lg font-semibold">VendorPro</span>
        </a>
        
        <div class="flex items-center gap-2">
          <a href="{{ route('profile.edit') }}" class="p-2 rounded-full text-slate-400 hover:text-white hover:bg-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </a>
        </div>
      </header>

      <!-- Desktop Header -->
      <header class="sticky top-0 z-30 hidden h-16 px-6 border-b border-slate-800/50 bg-slate-900/80 backdrop-blur-md md:flex">
        <div class="flex items-center justify-between w-full">
          <nav class="flex space-x-6">
            <a href="{{ route('vendor.dashboard') }}" 
               class="flex items-center px-1 pt-1 text-sm font-medium nav-link {{ request()->routeIs('vendor.dashboard') ? 'active text-white' : 'text-slate-400 hover:text-white' }}">
              Dashboard
            </a>
            <a href="{{ route('vendor.products.home') }}" 
               class="flex items-center px-1 pt-1 text-sm font-medium nav-link {{ request()->routeIs('vendor.products.*') ? 'active text-white' : 'text-slate-400 hover:text-white' }}">
              Products
            </a>
            <a href="{{ route('vendor.orders.index') }}" 
               class="flex items-center px-1 pt-1 text-sm font-medium nav-link {{ request()->routeIs('vendor.orders.*') ? 'active text-white' : 'text-slate-400 hover:text-white' }}">
              Orders
            </a>
            <a href="{{ route('vendor.arrivals.index') }}" 
               class="flex items-center px-1 pt-1 text-sm font-medium nav-link {{ request()->routeIs('vendor.arrivals.*') ? 'active text-white' : 'text-slate-400 hover:text-white' }}">
              Arrivals
            </a>
            <a href="{{ route('vendor.reviews.index') }}" 
               class="flex items-center px-1 pt-1 text-sm font-medium nav-link {{ request()->routeIs('vendor.reviews.*') ? 'active text-white' : 'text-slate-400 hover:text-white' }}">
              Reviews
            </a>
          </nav>
          
          <div class="flex items-center gap-4">
            <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-400 hover:text-white"></a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="px-3 py-1.5 text-sm font-medium rounded-md bg-slate-800/50 text-slate-300 hover:bg-slate-800 hover:text-white">
                Logout
              </button>
            </form>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 p-6">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Mobile Sidebar (Drawer) -->
  <div x-data="{ sidebarOpen: false }" class="md:hidden">
    <div x-show="sidebarOpen" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm" @click="sidebarOpen = false"></div>
    
    <div x-show="sidebarOpen" x-transition class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900">
      <div class="flex flex-col h-full">
        <div class="flex items-center justify-between h-16 px-4 border-b border-slate-800/50">
          <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-2">
            <span class="text-lg font-semibold">VendorPro</span>
          </a>
          <button @click="sidebarOpen = false" class="p-2 -mr-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
          <a href="{{ route('vendor.dashboard') }}" @click="sidebarOpen = false"
             class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
          </a>
          
          <a href="{{ route('vendor.products.home') }}" @click="sidebarOpen = false"
             class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.products.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products
          </a>
          
          <a href="{{ route('vendor.orders.index') }}" @click="sidebarOpen = false"
             class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.orders.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Orders
          </a>
          
          <a href="{{ route('vendor.arrivals.index') }}" @click="sidebarOpen = false"
             class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.arrivals.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Arrivals
          </a>
          
          <a href="{{ route('vendor.reviews.index') }}" @click="sidebarOpen = false"
             class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('vendor.reviews.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/50' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            Reviews
          </a>
        </nav>
        
        <div class="p-4 border-t border-slate-800/50">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="relative">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-emerald-500"></div>
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 rounded-full border-slate-900"></span>
              </div>
              <div>
                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400">Vendor Account</p>
              </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="p-2 rounded-full text-slate-400 hover:text-white hover:bg-slate-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @stack('scripts')
</body>
</html>