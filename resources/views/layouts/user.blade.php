<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StumpZone | Sports Shop</title>
    @vite('resources/css/app.css') {{-- Required for Tailwind --}}
</head>
<body class="text-gray-900 bg-gray-50">

    @include('user.partials.navbar') {{-- Custom User Navbar --}}

    <main class="p-6 mx-auto max-w-7xl">
        @yield('content')
    </main>

</body>
</html>
