@auth
    @if (Auth::user()->usertype === 'user')
        @php
            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
            $currentRoute = request()->route()->getName();
        @endphp

        <nav x-data="{ open: false, sportsDropdown: false, profileDropdown: false, mobileMenuOpen: false }"
             class="fixed top-0 left-0 right-0 z-50 border-b shadow-xl bg-white/10 backdrop-blur-3xl border-white/30 animate-fade-in-down">
            <div class="px-4 mx-auto max-w-7xl">
                <div class="flex items-center justify-between h-14">

                    <!-- Logo -->
                    <div class="flex items-center space-x-3 group">
                        <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3">
                            <div class="p-1 rounded-lg shadow-md bg-gradient-to-tr from-blue-300 via-pink-300 to-purple-300 animate-pulse"></div>
                            <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent-400 via-primary-400 to-accent-400 animate-text-gradient">
                                STUMPZONE
                            </span>
                        </a>
                    </div>

                    <!-- Search -->
                    <form action="{{ route('customer.search') }}" method="GET" class="hidden w-1/2 mx-6 lg:flex">
                        <input type="text" name="query"
                               placeholder="Search equipment..."
                               class="w-full px-4 py-1.5 rounded-l-full text-sm text-white placeholder-white/60 bg-white/10 border border-white/30 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        <button type="submit"
                                class="px-4 py-1.5 bg-pink-500 text-white rounded-r-full hover:bg-pink-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>

                    <!-- Desktop Nav -->
                    <div class="items-center hidden space-x-6 text-sm lg:flex">
                        <a href="{{ route('customer.dashboard') }}"
                           class="font-medium transition text-white/80 hover:text-white {{ $currentRoute === 'customer.dashboard' ? 'text-white border-b-2 border-pink-400' : '' }}">Home</a>

                        <a href="{{ route('customer.about') }}" class="font-medium transition text-white/80 hover:text-white {{ $currentRoute === 'customer.about' ? 'text-white border-b-2 border-pink-400' : '' }}">About</a>
                        <a href="{{ route('customer.contact') }}" class="font-medium transition text-white/80 hover:text-white {{ $currentRoute === 'customer.contact' ? 'text-white border-b-2 border-pink-400' : '' }}">Contact</a>
                        <a href="{{ route('customer.delivery') }}" class="font-medium transition text-white/80 hover:text-white {{ $currentRoute === 'customer.delivery' ? 'text-white border-b-2 border-pink-400' : '' }}">Delivery</a>

                        <!-- Dropdown: Sports -->
                        <div class="relative">
                            <button @click="sportsDropdown = !sportsDropdown"
                                    class="flex items-center transition text-white/80 hover:text-white">
                                Sports
                                <svg :class="{ 'rotate-180': sportsDropdown }"
                                     class="w-4 h-4 ml-1 transition-transform duration-300"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="sportsDropdown"
                                 @click.away="sportsDropdown = false"
                                 class="absolute right-0 w-48 py-2 mt-2 border shadow-xl bg-white/20 backdrop-blur-2xl border-white/30 rounded-xl">
                                <a href="{{ route('customer.cricket') }}"
                                   class="block px-4 py-2 text-white/80 hover:bg-white/10 hover:text-white">Cricket</a>
                                <a href="{{ route('customer.football') }}"
                                   class="block px-4 py-2 text-white/80 hover:bg-white/10 hover:text-white">Football</a>
                                <a href="{{ route('customer.badminton') }}"
                                   class="block px-4 py-2 text-white/80 hover:bg-white/10 hover:text-white">Badminton</a>
                                <a href="{{ route('customer.basketball') }}"
                                   class="block px-4 py-2 text-white/80 hover:bg-white/10 hover:text-white">Basketball</a>
                                <a href="{{ route('customer.boxing') }}"
                                   class="block px-4 py-2 text-white/80 hover:bg-white/10 hover:text-white">Boxing</a>
                            </div>
                        </div>

                        <!-- Branches -->
                        <a href="{{ route('customer.branches') }}"
                           class="font-medium transition text-white/80 hover:text-white {{ $currentRoute === 'customer.branches' ? 'text-white border-b-2 border-pink-400' : '' }}">Branches</a>

                        <!-- Cart -->
                        <a href="{{ route('cart.view') }}" class="relative transition-transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-white/80 hover:text-white" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            @if($cartCount > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full animate-bounce">{{ $cartCount }}</span>
                            @endif
                        </a>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button @click="profileDropdown = !profileDropdown"
                                    class="transition text-white/80 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.79.64 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>
                            <div x-show="profileDropdown"
                                 @click.away="profileDropdown = false"
                                 class="absolute right-0 z-50 w-40 py-2 mt-2 border rounded-lg shadow-lg bg-white/20 backdrop-blur-xl border-white/30">
                                <a href="{{ route('profile.edit') }}"
                                   class="block px-4 py-2 text-white/80 hover:text-white hover:bg-white/10">Edit Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full px-4 py-2 text-left text-white/80 hover:text-white hover:bg-white/10">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Icon -->
                    <div class="flex items-center ml-4 space-x-2 lg:hidden">
                        <a href="{{ route('cart.view') }}" class="relative p-2 transition-transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-white/80 hover:text-white" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            @if($cartCount > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full animate-bounce">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-white rounded-lg bg-white/20">
                            <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Nav -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.away="mobileMenuOpen = false"
                 class="border-t lg:hidden bg-white/10 backdrop-blur-2xl border-white/20">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <!-- Mobile Search -->
                    <form action="{{ route('customer.search') }}" method="GET" class="px-3 py-2">
                        <div class="flex">
                            <input type="text" name="query"
                                   placeholder="Search equipment..."
                                   class="flex-1 px-4 py-1.5 rounded-l-full text-sm text-white placeholder-white/60 bg-white/10 border border-white/30 focus:outline-none focus:ring-2 focus:ring-pink-400">
                            <button type="submit"
                                    class="px-4 py-1.5 bg-pink-500 text-white rounded-r-full hover:bg-pink-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    
                    <a href="{{ route('customer.dashboard') }}"
                       class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-white/10 {{ $currentRoute === 'customer.dashboard' ? 'bg-white/20' : '' }}">
                        Home
                    </a>
                    
                    <a href="{{ route('customer.about') }}"
                       class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-white/10 {{ $currentRoute === 'customer.about' ? 'bg-white/20' : '' }}">
                        About
                    </a>
                    
                    <a href="{{ route('customer.contact') }}"
                       class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-white/10 {{ $currentRoute === 'customer.contact' ? 'bg-white/20' : '' }}">
                        Contact
                    </a>
                    
                    <a href="{{ route('customer.delivery') }}"
                       class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-white/10 {{ $currentRoute === 'customer.delivery' ? 'bg-white/20' : '' }}">
                        Delivery
                    </a>
                    
                    <!-- Mobile Sports Dropdown -->
                    <div x-data="{ mobileSportsOpen: false }" class="relative">
                        <button @click="mobileSportsOpen = !mobileSportsOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-base font-medium text-left text-white rounded-md hover:bg-white/10">
                            <span>Sports</span>
                            <svg :class="{ 'rotate-180': mobileSportsOpen }"
                                 class="w-4 h-4 ml-1 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="mobileSportsOpen" class="px-3 py-2 space-y-1">
                            <a href="{{ route('customer.cricket') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Cricket</a>
                            <a href="{{ route('customer.football') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Football</a>
                            <a href="{{ route('customer.badminton') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Badminton</a>
                            <a href="{{ route('customer.basketball') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Basketball</a>
                            <a href="{{ route('customer.boxing') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Boxing</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('customer.branches') }}"
                       class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-white/10 {{ $currentRoute === 'customer.branches' ? 'bg-white/20' : '' }}">
                        Branches
                    </a>
                    
                    <!-- Mobile Profile Dropdown -->
                    <div x-data="{ mobileProfileOpen: false }" class="relative">
                        <button @click="mobileProfileOpen = !mobileProfileOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-base font-medium text-left text-white rounded-md hover:bg-white/10">
                            <span>Profile</span>
                            <svg :class="{ 'rotate-180': mobileProfileOpen }"
                                 class="w-4 h-4 ml-1 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="mobileProfileOpen" class="px-3 py-2 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-3 py-2 text-sm rounded-md text-white/80 hover:bg-white/10 hover:text-white">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full px-3 py-2 text-sm text-left rounded-md text-white/80 hover:bg-white/10 hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endif
@endauth