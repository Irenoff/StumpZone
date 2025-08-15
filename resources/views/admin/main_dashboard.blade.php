@extends('layouts.app')

@section('content')
<div class="min-h-screen px-6 py-12 bg-gradient-to-br from-gray-900 to-purple-900">
    <div class="max-w-6xl p-8 mx-auto border shadow-2xl bg-white/10 backdrop-blur-lg rounded-2xl border-white/20">
        <h1 class="mb-10 text-4xl font-bold text-center text-white">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">Admin Control Panel</span>
        </h1>
        
        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
            <!-- � Cricket -->
            <a href="{{ route('admin.cricket.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-cyan-400 hover:shadow-lg hover:shadow-cyan-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-amber-400 to-amber-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-baseball-ball"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Cricket</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-amber-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- ⚽ Football -->
            <a href="{{ route('admin.football.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-emerald-400 hover:shadow-lg hover:shadow-emerald-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-emerald-400 to-emerald-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-futbol"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Football</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-emerald-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- 🥊 Boxing -->
            <a href="{{ route('admin.boxing.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-red-400 hover:shadow-lg hover:shadow-red-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-red-400 to-red-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-boxing-glove"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Boxing</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-red-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- 🏀 Basketball -->
            <a href="{{ route('admin.basketball.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-orange-400 hover:shadow-lg hover:shadow-orange-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-orange-400 to-orange-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-basketball-ball"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Basketball</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-orange-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- 🏸 Badminton -->
            <a href="{{ route('admin.badminton.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-yellow-400 hover:shadow-lg hover:shadow-yellow-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-yellow-400 to-yellow-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-table-tennis"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Badminton</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-yellow-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- 👥 Users -->
            <a href="{{ route('admin.users.index') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-blue-400 hover:shadow-lg hover:shadow-blue-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-blue-400 to-blue-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-users"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Users</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-blue-400/10 to-transparent group-hover:opacity-100"></div>
            </a>
<!-- 📦 Orders -->
<a href="{{ route('admin.orders.index') }}"
   class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-purple-400 hover:shadow-lg hover:shadow-purple-400/20">
  <div class="flex flex-col items-center p-6">
      <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-purple-400 to-purple-600 group-hover:scale-110">
          <i class="text-2xl text-white fas fa-box"></i>
      </div>
      <span class="text-lg font-semibold text-white">Orders</span>
  </div>
  <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-purple-400/10 to-transparent group-hover:opacity-100"></div>
</a>


            <!-- 🚚 Deliveries -->
            <a href="{{ route('admin.deliveries.dashboard') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-indigo-400 hover:shadow-lg hover:shadow-indigo-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-indigo-400 to-indigo-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-truck"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">Deliveries</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-indigo-400/10 to-transparent group-hover:opacity-100"></div>
            </a>

            <!-- ✨ New Arrivals -->
            <a href="{{ route('admin.arrivals.create') }}" class="relative overflow-hidden transition-all duration-300 border group bg-white/5 rounded-xl border-white/10 hover:border-pink-400 hover:shadow-lg hover:shadow-pink-400/20">
                <div class="flex flex-col items-center p-6">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 transition-transform rounded-full shadow-lg bg-gradient-to-br from-pink-400 to-pink-600 group-hover:scale-110">
                        <i class="text-2xl text-white fas fa-star"></i>
                    </div>
                    <span class="text-lg font-semibold text-white">New Arrivals</span>
                </div>
                <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-br from-pink-400/10 to-transparent group-hover:opacity-100"></div>
            </a>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-3">
            <div class="p-6 border bg-white/5 rounded-xl border-white/10 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/70">Total Users</p>
                        <p class="mt-1 text-2xl font-bold text-white">1,248</p>
                    </div>
                    <div class="p-3 rounded-full bg-cyan-500/10">
                        <i class="fas fa-users text-cyan-400"></i>
                    </div>
                </div>
                <div class="h-1 mt-4 overflow-hidden rounded-full bg-white/10">
                    <div class="h-full rounded-full bg-cyan-400" style="width: 75%"></div>
                </div>
            </div>

            <div class="p-6 border bg-white/5 rounded-xl border-white/10 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/70">Active Orders</p>
                        <p class="mt-1 text-2xl font-bold text-white">326</p>
                    </div>
                    <div class="p-3 rounded-full bg-purple-500/10">
                        <i class="text-purple-400 fas fa-box"></i>
                    </div>
                </div>
                <div class="h-1 mt-4 overflow-hidden rounded-full bg-white/10">
                    <div class="h-full bg-purple-400 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <div class="p-6 border bg-white/5 rounded-xl border-white/10 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/70">Today's Revenue</p>
                        <p class="mt-1 text-2xl font-bold text-white">$8,742</p>
                    </div>
                    <div class="p-3 rounded-full bg-emerald-500/10">
                        <i class="fas fa-dollar-sign text-emerald-400"></i>
                    </div>
                </div>
                <div class="h-1 mt-4 overflow-hidden rounded-full bg-white/10">
                    <div class="h-full rounded-full bg-emerald-400" style="width: 62%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    .dashboard-card {
        transition: all 0.3s ease;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
    }
    
    /* Custom icon for boxing */
    .fa-boxing-glove:before {
        content: "🥊";
    }
</style>
@endsection