<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800/50 backdrop-blur-md">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full shadow-lg bg-gradient-to-br from-primary-500 to-accent-500 shadow-primary-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 2v20M6 6h12M6 18h12M6 12h12" stroke-width="3" />
                                <circle cx="12" cy="12" r="4" class="fill-white/20 stroke-white"/>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-accent-400 font-display">StumpZone</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="items-center hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 text-gray-300 transition-all duration-300 rounded-lg hover:text-white hover:bg-gray-800/50">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Sports Dropdown using Alpine.js -->
                    <div class="relative" x-data="{ openSports: false }">
                        <button @click="openSports = !openSports" class="px-3 py-2 text-gray-300 transition-all duration-300 rounded-lg hover:text-white hover:bg-gray-800/50">
                            Sports
                        </button>
                        <div x-show="openSports" @click.away="openSports = false" x-transition
                            class="absolute z-50 mt-2 bg-white rounded shadow-lg text-gray-800 min-w-[140px]">
                            <a href="{{ route('customer.sport', 'football') }}" class="block px-4 py-2 hover:bg-gray-100">Football</a>
                            <a href="{{ route('customer.sport', 'cricket') }}" class="block px-4 py-2 hover:bg-gray-100">Cricket</a>
                            <a href="{{ route('customer.sport', 'basketball') }}" class="block px-4 py-2 hover:bg-gray-100">Basketball</a>
                            <a href="{{ route('customer.sport', 'badminton') }}" class="block px-4 py-2 hover:bg-gray-100">Badminton</a>
                            <a href="{{ route('customer.sport', 'boxing') }}" class="block px-4 py-2 hover:bg-gray-100">Boxing</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-300 transition-all duration-300 border border-transparent rounded-lg bg-gray-800/50 hover:bg-gray-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-primary-500/50">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 mr-2 rounded-full bg-gradient-to-br from-primary-500/20 to-accent-500/20">
                                    <span class="text-sm font-medium text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="w-4 h-4 ml-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-1 border rounded-lg shadow-xl bg-gray-800/90 backdrop-blur-md border-gray-700/50">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-white hover:bg-gray-700/50">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:text-white hover:bg-gray-700/50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 focus:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t sm:hidden bg-gray-900/95 backdrop-blur-lg border-gray-800/50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Sports Links (mobile view only, no dropdown needed) -->
            <x-responsive-nav-link :href="route('customer.sport', 'football')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">Football</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customer.sport', 'cricket')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">Cricket</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customer.sport', 'basketball')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">Basketball</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customer.sport', 'badminton')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">Badminton</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customer.sport', 'boxing')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">Boxing</x-responsive-nav-link>
        </div>

        <!-- User Info + Logout -->
        <div class="pt-4 pb-1 border-t border-gray-800/50">
            <div class="px-4">
                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300 hover:text-white hover:bg-gray-800/50">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:text-white hover:bg-gray-800/50">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
