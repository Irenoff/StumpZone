@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 py-8 bg-gray-50 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col items-start justify-between mb-6 space-y-4 sm:space-y-0 sm:flex-row sm:items-center">
            <h2 class="text-2xl font-bold text-gray-800">👥 All Users</h2>
            
            <!-- Add User Button -->
            <button onclick="toggleAddUserForm()" 
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Add New User
            </button>
        </div>

        <!-- Add User Form (Hidden by default) -->
        <div id="addUserForm" class="hidden p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-medium text-gray-800">Add New User</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
                        <select name="usertype" id="usertype" required
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address (Optional)</label>
                        <input type="text" name="address" id="address"
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
                
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" onclick="toggleAddUserForm()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add User
                    </button>
                </div>
            </form>
        </div>

        <!-- Users Table -->
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
                        <th class="px-6 py-3">Actions</th>
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
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this.form)" 
                                            class="px-3 py-1 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Delete
                                    </button>
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

<script>
    // Toggle Add User Form
    function toggleAddUserForm() {
        const form = document.getElementById('addUserForm');
        form.classList.toggle('hidden');
        
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Confirm Delete Function
    function confirmDelete(form) {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            form.submit();
        }
    }
</script>
@endsection