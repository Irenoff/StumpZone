<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>StumpZone - Register</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:800|roboto:400,500" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-big-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            background: linear-gradient(90deg, #0ea5e9 0%, #f97316 100%);
            background-size: 200% 200%;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
            animation: text-gradient 8s ease-in-out infinite;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 24px rgba(0,0,0,0.18);
        }
        
        @keyframes text-gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: auto;
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Custom animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }
        
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(25px) rotate(-5deg); }
        }
        
        @keyframes flicker {
            0%, 19.999%, 22%, 62.999%, 64%, 64.999%, 70%, 100% { opacity: 1; }
            20%, 21.999%, 63%, 63.999%, 65%, 69.999% { opacity: 0.5; }
        }
        
        .animate-float {
            animation: float 8s ease-in-out infinite;
        }
        
        .animate-float-reverse {
            animation: float-reverse 7s ease-in-out infinite;
        }
        
        .animate-spin-slow {
            animation: spin 25s linear infinite;
        }
        
        .animate-flicker {
            animation: flicker 4s linear infinite;
        }
        
        .animate-pulse-slow {
            animation: pulse 5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .bg-stadium-lights {
            background-image: radial-gradient(ellipse at top, rgba(255, 255, 255, 0.03) 0%, transparent 70%);
        }
        
        .bg-cricket-field {
            background-image: radial-gradient(ellipse at center, rgba(6, 78, 59, 0.2) 0%, rgba(6, 78, 59, 0) 70%);
        }
        
        .bg-pattern-grid {
            background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHJlY3Qgd2lkdGg9IjUwIiBoZWlnaHQ9IjUwIiBmaWxsPSJ0cmFuc3BhcmVudCIvPjxwYXRoIGQ9Ik0wIDBMNTAgNTBNNTAgMEwwIDUwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==");
        }
    </style>
</head>
<body class="relative flex items-center justify-center min-h-screen px-4 overflow-hidden font-sans antialiased bg-gray-900">
    <!-- Ultra Dynamic Background -->
    <div class="fixed inset-0 z-0 overflow-hidden">
        <!-- Animated gradient background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 animate-[text-gradient_15s_ease_infinite] bg-[length:400%_400%]"></div>
        <!-- Stadium light effect -->
        <div class="absolute inset-0 bg-stadium-lights bg-pattern-grid opacity-30"></div>
        <!-- Floating cricket elements -->
        <div class="absolute w-32 h-32 rounded-full top-1/4 left-1/4 bg-accent-500/10 blur-2xl animate-float" data-speed="0.03"></div>
        <div class="absolute w-40 h-40 rounded-full top-1/3 right-1/4 bg-primary-500/10 blur-2xl animate-float-reverse" data-speed="0.04"></div>
        <div class="absolute rounded-full bottom-1/4 right-1/3 w-36 h-36 bg-accent-500/15 blur-2xl animate-float" data-speed="0.05"></div>
        <!-- Animated cricket elements -->
        <svg class="absolute w-40 h-40 top-1/3 left-1/5 text-accent-500/10 animate-spin-slow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-speed="0.02">
            <path d="M17 3L21 7M21 7L17 11M21 7H13M7 21L3 17M3 17L7 13M3 17H11" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg class="absolute w-32 h-32 bottom-1/4 right-1/5 text-primary-500/10 animate-spin-slow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-speed="0.03">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1"/>
            <path d="M12 2C6.477 2 2 6.477 2 12" stroke="currentColor" stroke-width="1"/>
            <path d="M12 22C17.523 22 22 17.523 22 12" stroke="currentColor" stroke-width="1"/>
        </svg>
        <!-- Stadium seating effect -->
        <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-gradient-to-t from-gray-900/90 via-gray-900/30 to-transparent"></div>
        <!-- Animated particles -->
        <div id="particles-js" class="absolute inset-0"></div>
    </div>

    <!-- Main registration card -->
    <div class="relative z-10 w-full max-w-md p-8 transition-all duration-500 transform border shadow-xl bg-gradient-to-br from-gray-800/90 via-gray-900/90 to-gray-800/90 backdrop-blur-lg rounded-xl hover:shadow-2xl hover:shadow-accent-500/30 border-gray-700/50 hover:-translate-y-1 group">
        <!-- Glow effect on hover -->
        <div class="absolute inset-0 transition-opacity duration-500 opacity-0 rounded-xl group-hover:opacity-100 bg-gradient-to-br from-accent-500/10 via-primary-500/10 to-accent-500/10"></div>
        
        <!-- Animated cricket logo with depth -->
        <div class="flex flex-col items-center mb-6">
            <div class="relative group">
                <div class="absolute inset-0 transition-all duration-700 rounded-full bg-accent-500/20 blur-xl group-hover:bg-accent-500/30 animate-pulse-slow"></div>
                <div class="absolute inset-0 transition-all duration-700 rounded-full bg-gradient-to-br from-accent-600/30 to-primary-500/30 opacity-70 group-hover:opacity-100"></div>
                <div class="relative flex items-center justify-center w-20 h-20 mx-auto transition-all duration-500 bg-gray-900 border rounded-full shadow-2xl border-gray-700/50 group-hover:border-accent-500/50 group-hover:shadow-accent-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 transition-colors duration-500 text-accent-400 group-hover:text-accent-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20M6 6h12M6 18h12M6 12h12" class="stroke-[3]"/>
                        <circle cx="12" cy="12" r="4" class="fill-accent-500/20 stroke-accent-400"/>
                    </svg>
                </div>
            </div>
            <h1 class="mt-4 mb-1 text-4xl font-bold text-center gradient-big-text">
                StumpZone
            </h1>
            <p class="mb-2 text-sm font-medium tracking-widest text-center text-gray-400 uppercase">
                Create Your Sports Account
            </p>
        </div>

        @if ($errors->any())
            <div class="px-4 py-3 mb-4 text-sm border-l-4 rounded text-accent-200 bg-accent-900/30 border-accent-500 backdrop-blur-sm">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-accent-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="flex items-center block text-sm font-medium text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Full Name
                </label>
                <div class="relative">
                    <input
                        id="name"
                        name="name"
                        type="text"
                        required
                        autofocus
                        value="{{ old('name') }}"
                        class="w-full py-3 pl-4 pr-4 text-gray-200 placeholder-gray-500 transition-all duration-300 border border-gray-700 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 backdrop-blur-sm hover:bg-gray-800/70 focus:shadow-lg focus:shadow-primary-500/10"
                        placeholder="John Doe"
                    />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-accent-300" />
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="flex items-center block text-sm font-medium text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Address
                </label>
                <div class="relative">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full py-3 pl-4 pr-4 text-gray-200 placeholder-gray-500 transition-all duration-300 border border-gray-700 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 backdrop-blur-sm hover:bg-gray-800/70 focus:shadow-lg focus:shadow-primary-500/10"
                        placeholder="your@email.com"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-accent-300" />
            </div>

            <!-- Address -->
            <div class="space-y-2">
                <label for="address" class="flex items-center block text-sm font-medium text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Address
                </label>
                <div class="relative">
                    <input
                        id="address"
                        name="address"
                        type="text"
                        value="{{ old('address') }}"
                        class="w-full py-3 pl-4 pr-4 text-gray-200 placeholder-gray-500 transition-all duration-300 border border-gray-700 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 backdrop-blur-sm hover:bg-gray-800/70 focus:shadow-lg focus:shadow-primary-500/10"
                        placeholder="Your Street Address"
                    />
                </div>
                <x-input-error :messages="$errors->get('address')" class="mt-2 text-sm text-accent-300" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="flex items-center block text-sm font-medium text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Password
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="w-full py-3 pl-4 pr-4 text-gray-200 placeholder-gray-500 transition-all duration-300 border border-gray-700 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 backdrop-blur-sm hover:bg-gray-800/70 focus:shadow-lg focus:shadow-primary-500/10"
                        placeholder="••••••••"
                    />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-accent-300" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="flex items-center block text-sm font-medium text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Confirm Password
                </label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="w-full py-3 pl-4 pr-4 text-gray-200 placeholder-gray-500 transition-all duration-300 border border-gray-700 rounded-lg bg-gray-800/50 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 backdrop-blur-sm hover:bg-gray-800/70 focus:shadow-lg focus:shadow-primary-500/10"
                        placeholder="••••••••"
                    />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-accent-300" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <a href="{{ route('login') }}" class="relative z-50 flex items-center font-medium transition-colors duration-300 text-primary-400 hover:text-primary-300 hover:underline">
                    Already registered?
                </a>

                <button
                    type="submit"
                    class="relative px-6 py-3 overflow-hidden text-sm font-medium text-white transition-all duration-500 border rounded-lg shadow-lg bg-gradient-to-r from-accent-600 to-accent-500 hover:from-accent-500 hover:to-accent-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500/50 hover:shadow-accent-500/30 border-accent-600/50 hover:border-accent-400/50 group"
                    id="registerButton"
                >
                    <span class="relative z-10 flex items-center justify-center">
                        Register
                    </span>
                    <span class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-primary-500/20 to-transparent group-hover:opacity-100"></span>
                </button>
            </div>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-700/50"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-3 text-gray-500 rounded-full bg-gray-900/80 backdrop-blur-sm">Or continue with</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a href="#" class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-300 transition-colors duration-300 bg-gray-800/50 border border-gray-700 rounded-lg hover:bg-gray-800 hover:border-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 backdrop-blur-sm hover:shadow-md hover:shadow-primary-500/10">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd" />
                </svg>
                GitHub
            </a>
            <a href="#" class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-300 transition-colors duration-300 bg-gray-800/50 border border-gray-700 rounded-lg hover:bg-gray-800 hover:border-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 backdrop-blur-sm hover:shadow-md hover:shadow-primary-500/10">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                </svg>
                Twitter
            </a>
        </div>

        <p class="mt-8 text-sm text-center text-gray-500">
            Already have an account?
            <a href="{{ route('login') }}" class="relative z-50 font-medium transition-colors duration-300 text-primary-400 hover:text-primary-300 hover:underline">
                Login here
            </a>
        </p>
    </div>

    <!-- Particles.js for advanced background effects -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('particles-js')) {
                particlesJS('particles-js', {
                    "particles": {
                        "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                        "color": { "value": ["#0ea5e9", "#f97316", "#ffffff"] },
                        "shape": { "type": ["circle", "triangle", "polygon"], "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 6 } },
                        "opacity": { "value": 0.3, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } },
                        "size": { "value": 3, "random": true, "anim": { "enable": true, "speed": 2, "size_min": 0.1, "sync": false } },
                        "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.2, "width": 1 },
                        "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 } }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true },
                        "modes": { "grab": { "distance": 140, "line_linked": { "opacity": 0.5 } }, "push": { "particles_nb": 4 } }
                    },
                    "retina_detect": true
                });
            }
            
            // Ripple effect
            const registerButton = document.getElementById('registerButton');
            if (registerButton) {
                registerButton.addEventListener('click', function(e) {
                    const existingRipples = document.querySelectorAll('.ripple');
                    existingRipples.forEach(r => r.remove());
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    ripple.style.width = ripple.style.height = `${size}px`;
                    ripple.style.left = `${x}px`;
                    ripple.style.top = `${y}px`;
                    setTimeout(() => ripple.remove(), 1000);
                });
            }
        });
    </script>
</body>
</html>