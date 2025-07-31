@extends('layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="min-h-screen px-4 py-8 mx-auto bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50">
    
    <!-- Top Navigation with Floating Effect -->
    <div class="relative flex flex-col justify-between p-6 mb-8 overflow-hidden text-white shadow-2xl bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-700 rounded-2xl md:flex-row md:items-center">
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-0 left-0 w-32 h-32 bg-purple-300 rounded-full animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-indigo-300 rounded-full animate-pulse"></div>
        </div>
        
        <div class="relative flex flex-wrap gap-3">
            <a href="{{ route('admin.cricket.dashboard') }}" class="flex items-center px-6 py-2 space-x-2 transition-all transform bg-white rounded-full shadow-lg bg-opacity-20 backdrop-blur-sm hover:bg-opacity-30 hover:scale-105">
                <span class="text-xl">🏏</span>
                <span>Basketball</span>
            </a>
            <a href="{{ route('admin.football.dashboard') }}" class="flex items-center px-6 py-2 space-x-2 transition-all transform bg-white rounded-full shadow-lg backdrop-blur-sm bg-opacity-10 hover:bg-opacity-20 hover:scale-105">
                <span class="text-xl">⚽</span>
                <span>Football</span>
            </a>
            <button onclick="toggleForm()" class="flex items-center px-6 py-2 space-x-2 transition-all transform rounded-full shadow-lg bg-gradient-to-r from-pink-500 to-rose-500 hover:shadow-xl hover:scale-105">
                <span class="text-xl">➕</span>
                <span>Add New Item</span>
            </button>
        </div>
        <div class="relative mt-4 text-right md:mt-0">
            <div class="inline-flex items-center px-6 py-3 space-x-2 bg-white rounded-full backdrop-blur-sm bg-opacity-10">
                <span class="text-2xl">📊</span>
                <div>
                    <strong class="text-2xl font-bold">{{ count($items) }}</strong> 
                    <span class="text-purple-100">{{ count($items) === 1 ? 'item' : 'items' }} in inventory</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Form with Slide Animation -->
    <div id="addForm" class="hidden transition-all duration-300 ease-in-out transform">
        <div class="p-8 mb-10 border-2 border-purple-200 shadow-xl bg-gradient-to-br from-white to-purple-50 rounded-2xl">
            <form action="{{ route('admin.cricket.store') }}" method="POST" enctype="multipart/form-data" id="itemForm">
                @csrf
                <h2 class="mb-6 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                    ✨ Add New Cricket Equipment
                </h2>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-purple-700">Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required 
                               class="w-full px-4 py-3 placeholder-purple-300 transition-all border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                               placeholder="e.g. Cricket Bat">
                        <p class="text-xs text-purple-500">Enter the product name (3-100 characters)</p>
                    </div>
                    
                    <!-- Price Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-purple-700">Price ($) <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute text-purple-400 left-3 top-3">$</span>
                            <input type="number" name="price" step="0.01" min="0.01" required 
                                   class="w-full py-3 pl-8 pr-4 transition-all border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                                   placeholder="0.00">
                        </div>
                        <p class="text-xs text-purple-500">Enter a valid price greater than 0</p>
                    </div>
                    
                    <!-- Image Upload with Preview -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-medium text-purple-700">Image</label>
                        <div class="flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <div class="relative flex-shrink-0 w-32 h-32 overflow-hidden border-2 border-purple-200 rounded-xl">
                                <img id="imagePreview" src="https://via.placeholder.com/300x300?text=Upload+Image" 
                                     class="object-cover w-full h-full">
                                <div id="removeImageBtn" class="absolute top-0 right-0 p-1 text-white bg-red-500 rounded-full opacity-0 cursor-pointer hover:opacity-100">
                                    ✕
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" id="imageInput" accept="image/*" 
                                       class="w-full px-4 py-3 transition-all border-2 border-purple-200 rounded-xl file:bg-purple-100 file:text-purple-700 file:border-0 file:px-4 file:py-2 file:rounded-lg file:mr-4">
                                <p class="mt-1 text-xs text-purple-500">JPEG, PNG or GIF (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description Field -->
                    <div class="space-y-2 md:col-span-3">
                        <label class="block text-sm font-medium text-purple-700">Description <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="4" required 
                                  class="w-full px-4 py-3 transition-all border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                                  placeholder="Describe the product features..."></textarea>
                        <p class="text-xs text-purple-500">Minimum 10 characters, maximum 500 characters</p>
                    </div>
                    
                    <!-- Stock Quantity -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-purple-700">Stock Quantity <span class="text-rose-500">*</span></label>
                        <input type="number" name="quantity" min="0" required 
                               class="w-full px-4 py-3 transition-all border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                               placeholder="0">
                    </div>
                    
                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-purple-700">Status</label>
                        <select name="status" 
                                class="w-full px-4 py-3 transition-all border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                            <option value="available" selected>Available</option>
                            <option value="out_of_stock">Out of Stock</option>
                            <option value="pre_order">Pre-order</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-wrap justify-end gap-4 mt-8">
                    <button type="button" onclick="toggleForm()" 
                            class="px-8 py-3 font-medium text-purple-700 transition-all transform bg-purple-100 rounded-full hover:bg-purple-200 hover:scale-105 active:scale-95">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-8 py-3 font-medium text-white transition-all transform rounded-full shadow-lg bg-gradient-to-r from-purple-600 to-pink-500 hover:shadow-xl hover:scale-105 active:scale-95">
                        Save Equipment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Inventory Table with Enhanced Features -->
    <div class="p-6 bg-white shadow-xl rounded-2xl">
        @if($items->isEmpty())
            <!-- Empty State with Animation -->
            <div class="py-20 text-center bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl animate-fade-in">
                <div class="inline-block p-6 mb-6 bg-white rounded-full shadow-lg">
                    <span class="text-6xl text-purple-500">🏏</span>
                </div>
                <h3 class="mb-3 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Your Cricket Inventory is Empty</h3>
                <p class="max-w-md mx-auto text-lg text-gray-600">Start building your cricket equipment collection by adding your first item.</p>
                <button onclick="toggleForm()" 
                        class="px-8 py-3 mt-6 text-white transition-all transform rounded-full shadow-lg bg-gradient-to-r from-purple-500 to-pink-500 hover:shadow-xl hover:scale-105 active:scale-95">
                    Add Your First Item
                </button>
            </div>
        @else
            <!-- Search and Filter Bar -->
            <div class="flex flex-col mb-6 space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 sm:items-center sm:justify-between">
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Search equipment..." 
                           class="w-full py-2 pl-10 pr-4 border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                </div>
                
                <div class="flex space-x-3">
                    <select id="statusFilter" 
                            class="px-4 py-2 border-2 border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="available">Available</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="pre_order">Pre-order</option>
                    </select>
                </div>
            </div>
            
            <!-- Responsive Table Container -->
            <div class="overflow-hidden border-2 border-purple-100 shadow-sm rounded-xl">
                <table class="min-w-full divide-y-2 divide-purple-50">
                    <thead class="bg-gradient-to-r from-purple-600 to-indigo-600">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-white cursor-pointer sortable" data-column="name">
                                <div class="flex items-center space-x-1">
                                    <span>Name</span>
                                    <svg class="w-4 h-4 text-purple-200 sort-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-white">Image</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-white cursor-pointer sortable" data-column="price">
                                <div class="flex items-center space-x-1">
                                    <span>Price</span>
                                    <svg class="w-4 h-4 text-purple-200 sort-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-white">Stock</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-white">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold text-right text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y-2 divide-purple-50" id="inventoryTableBody">
                        @foreach($items as $item)
                        <tr class="transition hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50" 
                            data-name="{{ strtolower($item->name) }}" 
                            data-status="{{ $item->status ?? 'available' }}">
                            <td class="px-6 py-4 font-bold text-purple-700">
                                <div class="flex items-center">
                                    <span class="mr-2">{{ $item->name }}</span>
                                    @if($item->status === 'out_of_stock')
                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">OUT OF STOCK</span>
                                    @elseif($item->status === 'pre_order')
                                        <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">PRE-ORDER</span>
                                    @endif
                                </div>
                                <div class="text-xs text-purple-500">{{ Str::limit($item->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/60?text=Cricket' }}" 
                                         class="object-cover w-12 h-12 border-2 border-purple-200 rounded-lg cursor-pointer hover:shadow-md hover:border-purple-400"
                                         onclick="showImageModal('{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/300?text=Cricket' }}', '{{ $item->name }}')">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-blue-600">
                                ${{ number_format($item->price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-16 mr-2 bg-purple-100 rounded-full h-2.5">
                                        @php
                                            $percentage = $item->quantity > 0 ? min(100, ($item->quantity / 50) * 100) : 0;
                                            $progressColor = $percentage > 50 ? 'bg-green-500' : ($percentage > 20 ? 'bg-yellow-500' : 'bg-red-500');
                                        @endphp
                                        <div class="h-2.5 rounded-full {{ $progressColor }}" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-purple-700">{{ $item->quantity }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'available' => 'bg-green-100 text-green-800',
                                        'out_of_stock' => 'bg-red-100 text-red-800',
                                        'pre_order' => 'bg-blue-100 text-blue-800'
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$item->status ?? 'available'] }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status ?? 'available')) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2 text-right">
                                <a href="{{ route('admin.cricket.edit', $item->id) }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all transform rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:shadow-lg hover:scale-105 active:scale-95"
                                   title="Edit">
                                   <span class="mr-1">✏️</span> Edit
                                </a>
                                <form action="{{ route('admin.cricket.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this.form)" 
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all transform rounded-full bg-gradient-to-r from-red-500 to-pink-500 hover:shadow-lg hover:scale-105 active:scale-95"
                                            title="Delete">
                                        <span class="mr-1">🗑️</span> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination with Styling -->
            @if(method_exists($items, 'links'))
                <div class="flex flex-col items-center mt-6 space-y-4 sm:flex-row sm:space-y-0 sm:justify-between">
                    <div class="text-sm text-purple-700">
                        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} items
                    </div>
                    <div class="flex space-x-2">
                        {{ $items->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75" onclick="hideImageModal()"></div>
        <div class="relative z-10 max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-xl">
            <button onclick="hideImageModal()" class="absolute top-0 right-0 p-2 m-2 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <h3 id="modalTitle" class="mb-4 text-xl font-bold text-purple-700"></h3>
            <img id="modalImage" src="" class="object-contain max-h-[70vh] w-full rounded-lg border-2 border-purple-100">
        </div>
    </div>
</div>

<script>
    // Toggle Add Form
    function toggleForm() {
        const form = document.getElementById('addForm');
        form.classList.toggle('hidden');
        
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // Reset form when showing
            document.getElementById('itemForm').reset();
            document.getElementById('imagePreview').src = 'https://via.placeholder.com/300x300?text=Upload+Image';
        }
    }

    // Image Preview Functionality
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('imagePreview').src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Remove Image Button
    document.getElementById('removeImageBtn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').src = 'https://via.placeholder.com/300x300?text=Upload+Image';
    });

    // Image Modal Functions
    function showImageModal(src, title) {
        document.getElementById('modalImage').src = src;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function hideImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Confirm Delete
    function confirmDelete(form) {
        if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
            form.submit();
        }
    }

    // Search Functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#inventoryTableBody tr');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            if (name.includes(searchTerm)) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    });

    // Filter Functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const status = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#inventoryTableBody tr');
        
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const statusMatch = !status || rowStatus === status;
            
            if (statusMatch) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    }

    // Sorting Functionality
    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.getAttribute('data-column');
            const isAsc = this.classList.contains('asc');
            
            // Reset all headers
            document.querySelectorAll('.sortable').forEach(h => {
                h.classList.remove('asc', 'desc');
            });
            
            // Set current header state
            this.classList.toggle('asc', !isAsc);
            this.classList.toggle('desc', isAsc);
            
            // Sort table
            sortTable(column, isAsc);
        });
    });

    function sortTable(column, isAsc) {
        const tbody = document.getElementById('inventoryTableBody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            const aValue = column === 'price' ? 
                parseFloat(a.querySelector(`td:nth-child(${column === 'name' ? 1 : 3})`).textContent.replace('$', '')) : 
                a.querySelector(`td:nth-child(${column === 'name' ? 1 : 3})`).textContent.toLowerCase();
                
            const bValue = column === 'price' ? 
                parseFloat(b.querySelector(`td:nth-child(${column === 'name' ? 1 : 3})`).textContent.replace('$', '')) : 
                b.querySelector(`td:nth-child(${column === 'name' ? 1 : 3})`).textContent.toLowerCase();
                
            return (isAsc ? 1 : -1) * (aValue > bValue ? 1 : aValue < bValue ? -1 : 0);
        });
        
        // Rebuild table
        rows.forEach(row => tbody.appendChild(row));
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .sort-icon {
        opacity: 0.5;
        transition: all 0.3s;
    }
    
    .sortable:hover .sort-icon {
        opacity: 1;
    }
    
    .asc .sort-icon {
        opacity: 1;
        transform: rotate(180deg);
    }
    
    .desc .sort-icon {
        opacity: 1;
        transform: rotate(0deg);
    }
    
    #removeImageBtn {
        transition: opacity 0.3s;
    }
    
    #imagePreview:hover + #removeImageBtn, #removeImageBtn:hover {
        opacity: 1;
    }
</style>
@endsection