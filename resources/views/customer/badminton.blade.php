@extends('customer.layouts.app')


@section('content')
    <!-- Gradient Background -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800"></div>
    
    <!-- Animated Background Particles -->
    <div id="particles-js" class="fixed top-0 left-0 w-full h-full -z-10 opacity-20"></div>
    
    <div class="relative z-10">
        <!-- Animated Header -->
        <div class="mb-12 text-center">
            <h2 class="mb-3 text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-500 md:text-5xl animate-fade-in-down">
                <i class="mr-2 fas fa-table-tennis-paddle-ball"></i>
                Badminton Equipment
            </h2>
            <p class="text-lg text-blue-300 animate-fade-in-up">Premium gear for champions</p>
            <div class="w-24 h-1 mx-auto mt-4 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 animate-grow-x"></div>
        </div>

        <!-- Equipment Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($items as $item)
                <div class="overflow-hidden transition-all duration-500 transform bg-gray-800 border border-gray-700 shadow-xl rounded-xl hover:shadow-2xl hover:-translate-y-3 group backdrop-blur-sm bg-opacity-70 hover:border-blue-500">
                    <!-- Product Image with Hover Zoom -->
                    <div class="relative overflow-hidden cursor-pointer" onclick="showProductDetails({{ json_encode([
                        'id' => $item->id,
                        'name' => $item->name,
                        'description' => $item->description,
                        'price' => $item->price,
                        'image_path' => $item->image_path,
                        'status' => $item->status,
                        'quantity' => $item->quantity,
                        'size' => $item->size,
                        'in_cart' => $item->in_cart ?? false
                    ]) }})">
                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             alt="{{ $item->name }}"
                             class="object-cover w-full h-48 transition-transform duration-700 group-hover:scale-110">
                        <!-- Status Badge -->
                        <span class="absolute top-3 right-3 px-3 py-1 text-xs font-bold text-white rounded-full shadow-lg 
                                    @if($item->status === 'available') bg-gradient-to-r from-emerald-500 to-green-600
                                    @elseif($item->status === 'pre_order') bg-gradient-to-r from-amber-500 to-orange-600
                                    @else bg-gradient-to-r from-rose-500 to-pink-600 @endif">
                            @if($item->status === 'pre_order') Pre-order
                            @elseif($item->quantity > 0) {{ $item->quantity }} in stock
                            @else Out of stock @endif
                        </span>
                    </div>

                    <!-- Product Details -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-white">{{ $item->name }}</h3>
                            <span class="px-2 py-1 text-xs font-semibold 
                                      @if($item->status === 'available') text-blue-200 bg-blue-900
                                      @elseif($item->status === 'pre_order') text-amber-200 bg-amber-900
                                      @else text-red-200 bg-red-900 @endif bg-opacity-50 rounded-full">
                                <i class="mr-1 fas 
                                      @if($item->status === 'available') fa-check-circle
                                      @elseif($item->status === 'pre_order') fa-hourglass-half
                                      @else fa-times-circle @endif"></i>
                                @if($item->status === 'pre_order') Pre-order
                                @else {{ $item->quantity > 0 ? 'Available' : 'Out of stock' }} @endif
                            </span>
                        </div>
                        
                        <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Rs {{ $item->price }}</p>
                        
                        <!-- Add to Cart Button -->
                        <div class="mt-5">
                            @if($item->status === 'available' && $item->quantity > 0)
                                @if($item->in_cart ?? false)
                                    <div class="w-full px-6 py-3 text-center text-white bg-green-600 rounded-xl">
                                        <i class="mr-2 fas fa-check-circle"></i>
                                        Already in Cart
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="equipment_id" value="{{ $item->id }}">
                                        <input type="hidden" name="sport_type" value="badminton">
                                        <button type="submit"
                                                class="w-full px-6 py-3 text-sm font-medium text-white transition-all duration-300 transform bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl hover:from-blue-700 hover:to-cyan-700 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 shadow-lg hover:shadow-blue-500/20">
                                            <span class="flex items-center justify-center">
                                                <i class="mr-2 fas fa-shopping-cart"></i>
                                                Add to Cart
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            @elseif($item->status === 'pre_order')
                                @if($item->in_cart ?? false)
                                    <div class="w-full px-6 py-3 text-center text-white bg-amber-600 rounded-xl">
                                        <i class="mr-2 fas fa-check-circle"></i>
                                        Pre-ordered
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="equipment_id" value="{{ $item->id }}">
                                        <input type="hidden" name="sport_type" value="badminton">
                                        <button type="submit"
                                                class="w-full px-6 py-3 text-sm font-medium text-white transition-all duration-300 transform bg-gradient-to-r from-amber-600 to-orange-600 rounded-xl hover:from-amber-700 hover:to-orange-700 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-gray-800 shadow-lg hover:shadow-amber-500/20">
                                            <span class="flex items-center justify-center">
                                                <i class="mr-2 fas fa-hourglass-half"></i>
                                                Pre-order Now
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="w-full px-6 py-3 text-center border text-cyan-200 bg-cyan-900 border-cyan-800 bg-opacity-30 rounded-xl">
                                    <i class="mr-2 fas fa-exclamation-circle"></i>
                                    Out of Stock
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Product Details Modal -->
    <div id="productModal" class="fixed inset-0 z-50 hidden overflow-y-auto" onclick="closeModal()">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="closeModal()">
                <div class="absolute inset-0 bg-gray-900 bg-opacity-75"></div>
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gray-800 rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" onclick="event.stopPropagation()">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="flex items-start justify-between">
                                <h3 id="modalTitle" class="mb-4 text-2xl font-bold leading-6 text-white"></h3>
                                <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="mt-2">
                                <img id="modalImage" src="" alt="" class="object-cover w-full h-64 mb-4 rounded-lg">
                                <p id="modalDescription" class="mb-6 text-gray-300"></p>
                                
                                <!-- Size Information -->
                                <div class="mb-6">
                                    <h4 class="mb-2 text-lg font-semibold text-white">Available Sizes:</h4>
                                    <div id="sizeContainer" class="flex flex-wrap gap-2">
                                        <!-- Sizes will be dynamically inserted here -->
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between mb-6">
                                    <span id="modalPrice" class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400"></span>
                                    <span id="modalStock" class="px-3 py-1 text-sm font-bold text-white rounded-full shadow-lg">
                                        <i class="mr-1 fas fa-box-open"></i>
                                        <span id="stockStatus"></span>
                                    </span>
                                </div>
                                
                                <form id="quantityForm" method="POST" action="{{ route('cart.add') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="equipment_id" id="modalEquipmentId" value="">
                                    <input type="hidden" name="sport_type" value="badminton">
                                    <input type="hidden" name="selected_size" id="selectedSize" value="">
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center" id="quantityControls">
                                            <!-- Quantity controls will be shown/hidden based on product status -->
                                        </div>
                                        
                                        <div id="cartButtonContainer">
                                            <!-- Button will be dynamically inserted here -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN for Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <script>
        // Initialize particles.js
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#3b82f6"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        }
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": false
                    },
                    "size": {
                        "value": 3,
                        "random": true
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#93c5fd",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    }
                }
            });
        });

        // Product details modal functions
        function showProductDetails(item) {
            document.getElementById('modalTitle').textContent = item.name;
            document.getElementById('modalImage').src = "{{ asset('storage/') }}" + '/' + item.image_path;
            document.getElementById('modalDescription').textContent = item.description;
            document.getElementById('modalPrice').textContent = 'RS ' + item.price;
            document.getElementById('modalEquipmentId').value = item.id;
            
            // Display available sizes
            const sizeContainer = document.getElementById('sizeContainer');
            sizeContainer.innerHTML = '';
            
            if (item.size && item.size.trim().length > 0) {
                const sizes = item.size.split(',');
                sizes.forEach(size => {
                    const sizeElement = document.createElement('div');
                    sizeElement.className = 'px-3 py-1 text-sm font-medium text-white bg-gray-700 rounded-full cursor-pointer hover:bg-blue-600 size-option';
                    sizeElement.textContent = size.trim();
                    sizeElement.dataset.size = size.trim();
                    sizeElement.onclick = function() {
                        document.getElementById('selectedSize').value = size.trim();
                        // Remove active class from all size options
                        document.querySelectorAll('.size-option').forEach(el => {
                            el.classList.remove('bg-blue-600');
                            el.classList.add('bg-gray-700');
                        });
                        // Add active class to selected size
                        this.classList.remove('bg-gray-700');
                        this.classList.add('bg-blue-600');
                    };
                    sizeContainer.appendChild(sizeElement);
                });
                
                // Select first size by default
                if (sizes[0]) {
                    document.getElementById('selectedSize').value = sizes[0].trim();
                    sizeContainer.firstChild.classList.remove('bg-gray-700');
                    sizeContainer.firstChild.classList.add('bg-blue-600');
                }
            } else {
                sizeContainer.innerHTML = '<p class="text-gray-400">No sizes available</p>';
            }
            
            const modalStock = document.getElementById('modalStock');
            const stockStatus = document.getElementById('stockStatus');
            const quantityControls = document.getElementById('quantityControls');
            const cartButtonContainer = document.getElementById('cartButtonContainer');
            const quantityForm = document.getElementById('quantityForm');
            
            if (item.status === 'pre_order') {
                stockStatus.textContent = 'Pre-order';
                modalStock.className = 'px-3 py-1 text-sm font-bold text-white rounded-full shadow-lg bg-gradient-to-r from-amber-500 to-orange-600';
                
                // Hide quantity controls for pre-order items
                quantityControls.innerHTML = '';
                
                if (item.in_cart) {
                    cartButtonContainer.innerHTML = `
                        <div class="px-6 py-2 text-white rounded-lg bg-amber-600">
                                            <span class="flex items-center">
                                                <i class="mr-2 fas fa-check-circle"></i>
                                                Already Pre-ordered
                                            </span>
                                        </div>
                    `;
                } else {
                    cartButtonContainer.innerHTML = `
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition-all duration-300 transform bg-gradient-to-r from-amber-600 to-orange-600 rounded-lg hover:from-amber-700 hover:to-orange-700 hover:scale-[1.02]">
                                            <span class="flex items-center">
                                                <i class="mr-2 fas fa-hourglass-half"></i>
                                                Pre-order Now
                                            </span>
                                        </button>
                    `;
                }
                
                // Enable form submission
                quantityForm.onsubmit = null;
            } else if (item.quantity > 0) {
                stockStatus.textContent = item.quantity + ' in stock';
                modalStock.className = 'px-3 py-1 text-sm font-bold text-white rounded-full shadow-lg bg-gradient-to-r from-emerald-500 to-green-600';
                
                // Show quantity controls for available items
                quantityControls.innerHTML = `
                    <button type="button" onclick="decreaseQuantity()" class="px-3 py-1 text-white bg-gray-700 rounded-l-lg hover:bg-gray-600">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" name="quantity" id="quantityInput" value="1" min="1" max="${item.quantity > 10 ? 10 : item.quantity}" 
                           class="w-16 py-1 text-center text-white bg-gray-800 border-t border-b border-gray-700">
                    <button type="button" onclick="increaseQuantity()" class="px-3 py-1 text-white bg-gray-700 rounded-r-lg hover:bg-gray-600">
                        <i class="fas fa-plus"></i>
                    </button>
                `;
                
                if (item.in_cart) {
                    cartButtonContainer.innerHTML = `
                        <div class="px-6 py-2 text-white bg-green-600 rounded-lg">
                                            <span class="flex items-center">
                                                <i class="mr-2 fas fa-check-circle"></i>
                                                Already in Cart
                                            </span>
                                        </div>
                    `;
                } else {
                    cartButtonContainer.innerHTML = `
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition-all duration-300 transform bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg hover:from-blue-700 hover:to-cyan-700 hover:scale-[1.02]">
                                            <span class="flex items-center">
                                                <i class="mr-2 fas fa-shopping-cart"></i>
                                                Add to Cart
                                            </span>
                                        </button>
                    `;
                }
                
                // Enable form submission
                quantityForm.onsubmit = null;
            } else {
                stockStatus.textContent = 'Out of stock';
                modalStock.className = 'px-3 py-1 text-sm font-bold text-white rounded-full shadow-lg bg-gradient-to-r from-rose-500 to-pink-600';
                
                // Hide quantity controls for out of stock items
                quantityControls.innerHTML = '';
                
                cartButtonContainer.innerHTML = `
                    <div class="px-6 py-2 text-gray-400 bg-gray-700 rounded-lg cursor-not-allowed">
                                        <span class="flex items-center">
                                            <i class="mr-2 fas fa-exclamation-circle"></i>
                                            Out of Stock
                                        </span>
                                    </div>
                `;
                
                // Disable form submission
                quantityForm.onsubmit = function(e) {
                    e.preventDefault();
                    return false;
                };
            }
            
            document.getElementById('productModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Quantity controls
        function increaseQuantity() {
            const input = document.getElementById('quantityInput');
            if (input) {
                const max = parseInt(input.max);
                if (parseInt(input.value) < max) {
                    input.value = parseInt(input.value) + 1;
                }
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantityInput');
            if (input && parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>

    <style>
        /* Custom Animations */
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes grow-x {
            0% {
                transform: scaleX(0);
            }
            100% {
                transform: scaleX(1);
            }
        }
        
        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out forwards;
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
            animation-delay: 0.3s;
        }
        
        .animate-grow-x {
            animation: grow-x 0.8s ease-out forwards;
            animation-delay: 0.6s;
            transform-origin: left;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #1e40af;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #1e3a8a;
        }

        /* Modal styling */
        #productModal {
            transition: opacity 0.3s ease;
        }
        
        /* Quantity input number arrows */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
        
        /* Prevent scrolling when modal is open */
        body.modal-open {
            overflow: hidden;
        }
        
        /* Stock indicator pulse animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .low-stock {
            animation: pulse 2s infinite;
        }

        /* Fixed button positioning */
        .p-6 {
            display: flex;
            flex-direction: column;
            height: calc(100% - 12rem); /* Adjust based on your image height */
        }

        .mt-5 {
            margin-top: auto;
            margin-bottom: 0;
        }
    </style>
@endsection