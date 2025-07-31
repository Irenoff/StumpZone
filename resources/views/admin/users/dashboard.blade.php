@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 py-8 bg-gray-50 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">

        <h2 class="mb-6 text-2xl font-bold text-gray-800">👥 All Users</h2>

        {{-- ✅ Add New User Form --}}
        <div class="p-6 mb-8 bg-white border border-gray-200 rounded-lg shadow">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">➕ Add New User</h3>

            @if(session('success'))
                <div class="mb-4 font-semibold text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <input type="text" name="name" placeholder="Name" required class="p-2 border border-gray-300 rounded">
                    <input type="email" name="email" placeholder="Email" required class="p-2 border border-gray-300 rounded">
                    <input type="password" name="password" placeholder="Password" required class="p-2 border border-gray-300 rounded">
                    <input type="text" name="address" placeholder="Address (optional)" class="p-2 border border-gray-300 rounded">
                    <select name="usertype" required class="p-2 border border-gray-300 rounded">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="vendor">Vendor</option>
                        <option value="deliver">Deliver</option>
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Add User
                </button>
            </form>
        </div>

        {{-- ✅ Users Table --}}
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-sm tracking-wider text-left text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">User Type</th>
                        <th class="px-6 py-3">Address</th>
                        <th class="px-6 py-3">Created At</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 capitalize">{{ $user->usertype }}</td>
                            <td class="px-6 py-4">{{ $user->address ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
