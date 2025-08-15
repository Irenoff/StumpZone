@auth
@if (Auth::user()->usertype === 'admin')
<nav class="px-6 py-4 text-white bg-gray-900 shadow-md">
    <div class="flex items-center justify-between mx-auto max-w-7xl">
        <div class="flex items-center space-x-6">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold hover:text-yellow-300">📊 Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="hover:text-yellow-300">👥 Manage Users</a>
            <a href="{{ route('admin.cricket.dashboard') }}" class="hover:text-yellow-300">🏏 Cricket</a>
            <a href="{{ route('admin.football.dashboard') }}" class="hover:text-yellow-300">⚽ Football</a>
            <a href="{{ route('admin.basketball.dashboard') }}" class="hover:text-yellow-300">🏀 Basketball</a>
            <a href="{{ route('admin.badminton.dashboard') }}" class="hover:text-yellow-300">🏸 Badminton</a>
            <a href="{{ route('admin.boxing.dashboard') }}" class="hover:text-yellow-300">🥊 Boxing</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-1 bg-red-600 rounded-md hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
</nav>
@endif
@endauth
