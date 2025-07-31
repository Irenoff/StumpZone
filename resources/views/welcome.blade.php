<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StumpZone</title>
    <!-- Remove the CDN and use your local Tailwind installation -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex items-center justify-center min-h-screen bg-center bg-cover" style="background-image: url('your-background-image-url-here')">

    <div class="w-full max-w-md p-10 text-center bg-white shadow-lg bg-opacity-90 backdrop-blur-md rounded-2xl">
        <h1 class="mb-6 text-4xl font-extrabold text-gray-800">Welcome to StumpZone 🏏</h1>
        <p class="mb-8 text-gray-600">Your one-stop shop for all cricket equipment</p>
        
        <a href="{{ route('login') }}"
           class="inline-block px-6 py-3 font-semibold text-white transition duration-300 bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
            Login
        </a>
    </div>

</body>
</html>