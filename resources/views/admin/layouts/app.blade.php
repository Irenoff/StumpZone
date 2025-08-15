<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Admin')</title>

  {{-- Use your project's assets if Vite is enabled --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Fallback: Tailwind CDN so pages still render if Vite isn’t loaded --}}
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen text-white bg-gray-950">
  {{-- Top bar --}}
  <header class="border-b border-white/10 bg-black/30 backdrop-blur">
    <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">
      <div class="text-lg font-bold">Admin Panel</div>
      <nav class="flex items-center gap-4 text-sm">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-fuchsia-300">Dashboard</a>
        <a href="{{ route('admin.arrivals.index') }}" class="hover:text-fuchsia-300">Arrivals</a>
        <a href="{{ route('home') }}" class="hover:text-fuchsia-300">Site</a>
      </nav>
    </div>
  </header>

  <main class="px-4 py-8 mx-auto max-w-7xl">
    @yield('content')
  </main>

  {{-- Page-specific scripts --}}
  @stack('scripts')
</body>
</html>
