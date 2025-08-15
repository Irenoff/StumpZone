@extends('layouts.app')

@section('title', 'Delivery – StumpZone')

@section('content')
<div class="min-h-screen text-white bg-gray-900">
  <!-- Animated Hero Section -->
  <div class="relative overflow-hidden">
    <div class="absolute inset-0 z-0">
      <div class="absolute inset-0 bg-gradient-to-br from-purple-900/30 to-pink-900/30"></div>
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')] bg-cover bg-center opacity-20"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/10 to-gray-900"></div>
    </div>
    
    <div class="relative z-10 max-w-6xl px-6 py-32 mx-auto text-center">
      <h1 class="text-6xl font-extrabold tracking-tight text-transparent md:text-7xl bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-pink-500 animate-text">
        Lightning Fast Delivery
      </h1>
      <p class="max-w-3xl mx-auto mt-6 text-2xl text-gray-300">
        Where speed meets reliability - get your orders faster than ever
      </p>
      <div class="mt-10">
        <div class="inline-flex items-center px-6 py-3 space-x-2 text-lg font-medium transition-all duration-300 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-lg hover:shadow-purple-500/20">
          <span>Track Your Order</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="px-6 pb-32 mx-auto max-w-7xl">
    <!-- Delivery Options - Card Grid -->
    <section class="mb-28">
      <div class="flex flex-col items-center mb-16">
        <span class="mb-4 text-sm font-semibold tracking-widest text-pink-400 uppercase">Delivery Options</span>
        <h2 class="text-4xl font-bold text-center">Choose Your Speed</h2>
        <div class="w-24 h-1 mt-4 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></div>
      </div>
      
      <div class="grid gap-8 md:grid-cols-3">
        <!-- Standard Delivery -->
        <div class="relative overflow-hidden transition-all duration-500 border border-gray-800 group rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 hover:border-pink-500/30 hover:shadow-xl hover:shadow-pink-500/10">
          <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500"></div>
          <div class="p-8">
            <div class="flex items-center justify-center w-20 h-20 mb-6 transition-all duration-300 border rounded-2xl bg-gradient-to-br from-purple-900/50 to-pink-900/50 border-purple-500/20 group-hover:shadow-lg group-hover:shadow-purple-500/10">
              <span class="text-3xl">🚛</span>
            </div>
            <h3 class="mb-3 text-2xl font-bold">Standard</h3>
            <div class="mb-6">
              <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Rs 750</span>
              <span class="text-gray-400"> / shipment</span>
            </div>
            <ul class="space-y-3 text-gray-300">
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>3-5 business days</span>
              </li>
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Basic tracking</span>
              </li>
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Eco-friendly packaging</span>
              </li>
            </ul>
          </div>
          <div class="px-8 pb-8">
            <button class="w-full px-6 py-3 font-medium transition-all duration-300 border border-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-purple-600/20 hover:to-pink-600/20 hover:border-pink-500/30">
              Select Standard
            </button>
          </div>
        </div>

        <!-- Express Delivery (Featured) -->
        <div class="relative z-10 overflow-hidden shadow-2xl rounded-2xl shadow-pink-500/20 group">
          <div class="absolute inset-0 bg-gradient-to-br from-pink-600 to-purple-600"></div>
          <div class="absolute top-0 right-0 px-4 py-1 text-xs font-bold text-pink-600 bg-white rounded-bl-lg">POPULAR</div>
          <div class="relative z-10 p-1 m-1 bg-gray-900 rounded-xl">
            <div class="p-8">
              <div class="flex items-center justify-center w-20 h-20 mb-6 transition-all duration-300 border rounded-2xl bg-gradient-to-br from-pink-700/50 to-purple-700/50 border-pink-400/30 group-hover:shadow-lg group-hover:shadow-pink-500/20">
                <span class="text-3xl">✈️</span>
              </div>
              <h3 class="mb-3 text-2xl font-bold text-white">Express</h3>
              <div class="mb-6">
                <span class="text-3xl font-bold text-white">Rs 1400</span>
                <span class="text-gray-300"> / shipment</span>
              </div>
              <ul class="space-y-3 text-gray-300">
                <li class="flex items-start">
                  <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span>1-2 business days</span>
                </li>
                <li class="flex items-start">
                  <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span>Priority processing</span>
                </li>
                <li class="flex items-start">
                  <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span>Real-time tracking</span>
                </li>
                <li class="flex items-start">
                  <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span>Delivery time windows</span>
                </li>
              </ul>
            </div>
            <div class="px-8 pb-8">
              <button class="w-full px-6 py-3 font-medium text-gray-900 transition-all duration-300 bg-white rounded-lg hover:bg-gray-100 hover:shadow-lg">
                Select Express
              </button>
            </div>
          </div>
        </div>

        <!-- Same Day Delivery -->
        <div class="relative overflow-hidden transition-all duration-500 border border-gray-800 group rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 hover:border-purple-500/30 hover:shadow-xl hover:shadow-purple-500/10">
          <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-500 to-purple-500"></div>
          <div class="p-8">
            <div class="flex items-center justify-center w-20 h-20 mb-6 transition-all duration-300 border rounded-2xl bg-gradient-to-br from-pink-900/50 to-purple-900/50 border-pink-500/20 group-hover:shadow-lg group-hover:shadow-pink-500/10">
              <span class="text-3xl">🚀</span>
            </div>
            <h3 class="mb-3 text-2xl font-bold">Over Night</h3>
            <div class="mb-6">
              <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400">RS 2400</span>
              <span class="text-gray-400"> / shipment</span>
            </div>
            <ul class="space-y-3 text-gray-300">
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Order by 12PM</span>
              </li>
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Personal delivery agent</span>
              </li>
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Signature required</span>
              </li>
              <li class="flex items-start">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Available in select areas</span>
              </li>
            </ul>
          </div>
          <div class="px-8 pb-8">
            <button class="w-full px-6 py-3 font-medium transition-all duration-300 border border-gray-700 rounded-lg hover:bg-gradient-to-r hover:from-pink-600/20 hover:to-purple-600/20 hover:border-purple-500/30">
              Select Same Day
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Delivery Process - Animated Steps -->
    <section class="mb-28">
      <div class="flex flex-col items-center mb-16">
        <span class="mb-4 text-sm font-semibold tracking-widest text-purple-400 uppercase">Our Process</span>
        <h2 class="text-4xl font-bold text-center">From Warehouse to Your Door</h2>
        <div class="w-24 h-1 mt-4 rounded-full bg-gradient-to-r from-pink-500 to-purple-500"></div>
      </div>
      
      <div class="relative">
        <!-- Animated line -->
        <div class="absolute left-0 right-0 h-1.5 transform -translate-y-1/2 bg-gradient-to-r from-pink-500 via-purple-500 to-pink-500 top-1/2 animate-gradient-x"></div>
        
        <div class="relative grid grid-cols-1 gap-12 md:grid-cols-4">
          <!-- Step 1 -->
          <div class="relative z-10 text-center">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 text-2xl font-bold rounded-full shadow-lg bg-gradient-to-br from-purple-600 to-pink-600 shadow-purple-500/20">
              1
            </div>
            <div class="px-6 py-8 transition-all duration-300 bg-gray-800 border border-gray-700 rounded-xl hover:border-pink-500/50 hover:shadow-lg hover:shadow-pink-500/10">
              <h3 class="mb-3 text-xl font-bold">Order Placed</h3>
              <p class="text-gray-400">We receive and verify your order details</p>
            </div>
          </div>
          
          <!-- Step 2 -->
          <div class="relative z-10 text-center">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 text-2xl font-bold rounded-full shadow-lg bg-gradient-to-br from-purple-600 to-pink-600 shadow-purple-500/20">
              2
            </div>
            <div class="px-6 py-8 transition-all duration-300 bg-gray-800 border border-gray-700 rounded-xl hover:border-purple-500/50 hover:shadow-lg hover:shadow-purple-500/10">
              <h3 class="mb-3 text-xl font-bold">Processing</h3>
              <p class="text-gray-400">Our team prepares your items with care</p>
            </div>
          </div>
          
          <!-- Step 3 -->
          <div class="relative z-10 text-center">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 text-2xl font-bold rounded-full shadow-lg bg-gradient-to-br from-purple-600 to-pink-600 shadow-purple-500/20">
              3
            </div>
            <div class="px-6 py-8 transition-all duration-300 bg-gray-800 border border-gray-700 rounded-xl hover:border-pink-500/50 hover:shadow-lg hover:shadow-pink-500/10">
              <h3 class="mb-3 text-xl font-bold">Shipped</h3>
              <p class="text-gray-400">Package dispatched with tracking info</p>
            </div>
          </div>
          
          <!-- Step 4 -->
          <div class="relative z-10 text-center">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 text-2xl font-bold rounded-full shadow-lg bg-gradient-to-br from-purple-600 to-pink-600 shadow-purple-500/20">
              4
            </div>
            <div class="px-6 py-8 transition-all duration-300 bg-gray-800 border border-gray-700 rounded-xl hover:border-purple-500/50 hover:shadow-lg hover:shadow-purple-500/10">
              <h3 class="mb-3 text-xl font-bold">Delivered</h3>
              <p class="text-gray-400">Your order arrives safely at your door</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Delivery Features -->
    <section class="mb-28">
      <div class="flex flex-col items-center mb-16">
        <span class="mb-4 text-sm font-semibold tracking-widest text-pink-400 uppercase">Why Choose Us</span>
        <h2 class="text-4xl font-bold text-center">Premium Delivery Experience</h2>
        <div class="w-24 h-1 mt-4 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></div>
      </div>
      
      <div class="grid gap-8 md:grid-cols-3">
        <!-- Feature 1 -->
        <div class="p-8 transition-all duration-500 border border-gray-800 rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 hover:border-pink-500/30 hover:shadow-xl hover:shadow-pink-500/10">
          <div class="flex items-center justify-center w-16 h-16 mb-6 border rounded-xl bg-gradient-to-br from-purple-900/50 to-pink-900/50 border-purple-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3 class="mb-3 text-xl font-bold">Secure Packaging</h3>
          <p class="text-gray-400">Every item is packed with multiple protective layers to ensure it arrives in perfect condition.</p>
        </div>
        
        <!-- Feature 2 -->
        <div class="p-8 transition-all duration-500 border border-gray-800 rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 hover:border-purple-500/30 hover:shadow-xl hover:shadow-purple-500/10">
          <div class="flex items-center justify-center w-16 h-16 mb-6 border rounded-xl bg-gradient-to-br from-purple-900/50 to-pink-900/50 border-purple-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="mb-3 text-xl font-bold">Lightning Fast</h3>
          <p class="text-gray-400">Our optimized logistics network ensures your package takes the fastest route possible.</p>
        </div>
        
        <!-- Feature 3 -->
        <div class="p-8 transition-all duration-500 border border-gray-800 rounded-2xl bg-gradient-to-br from-gray-800 to-gray-900 hover:border-pink-500/30 hover:shadow-xl hover:shadow-pink-500/10">
          <div class="flex items-center justify-center w-16 h-16 mb-6 border rounded-xl bg-gradient-to-br from-purple-900/50 to-pink-900/50 border-purple-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
            </svg>
          </div>
          <h3 class="mb-3 text-xl font-bold">Global Reach</h3>
          <p class="text-gray-400">We deliver to over 150 countries with reliable international shipping partners.</p>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="p-8 border border-gray-800 rounded-3xl bg-gradient-to-br from-gray-800 to-gray-900">
      <div class="flex flex-col items-center mb-12">
        <span class="mb-4 text-sm font-semibold tracking-widest text-purple-400 uppercase">Need Help?</span>
        <h2 class="text-4xl font-bold text-center">Delivery FAQs</h2>
        <div class="w-24 h-1 mt-4 rounded-full bg-gradient-to-r from-pink-500 to-purple-500"></div>
      </div>
      
      <div class="grid gap-6 md:grid-cols-2">
        <!-- FAQ Item 1 -->
        <div class="p-6 transition-all duration-300 border border-gray-700 rounded-xl bg-gray-800/50 hover:border-pink-500/30">
          <h3 class="flex items-center mb-3 text-xl font-semibold text-pink-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
            How do I track my order?
          </h3>
          <p class="text-gray-400">Once your order ships, you'll receive an email with a tracking number. Click the link in the email or enter the number on our tracking page to see real-time updates.</p>
        </div>
        
        <!-- FAQ Item 2 -->
        <div class="p-6 transition-all duration-300 border border-gray-700 rounded-xl bg-gray-800/50 hover:border-purple-500/30">
          <h3 class="flex items-center mb-3 text-xl font-semibold text-purple-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
            What's your return policy?
          </h3>
          <p class="text-gray-400">We offer 30-day returns for most items. The return shipping label cost will be deducted from your refund unless the return is due to our error.</p>
        </div>
        
        <!-- FAQ Item 3 -->
        <div class="p-6 transition-all duration-300 border border-gray-700 rounded-xl bg-gray-800/50 hover:border-pink-500/30">
          <h3 class="flex items-center mb-3 text-xl font-semibold text-pink-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
            Do you ship internationally?
          </h3>
          <p class="text-gray-400">Yes! We ship to over 150 countries. International orders may be subject to customs fees which are the responsibility of the recipient.</p>
        </div>
        
        <!-- FAQ Item 4 -->
        <div class="p-6 transition-all duration-300 border border-gray-700 rounded-xl bg-gray-800/50 hover:border-purple-500/30">
          <h3 class="flex items-center mb-3 text-xl font-semibold text-purple-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
            What if my package is damaged?
          </h3>
          <p class="text-gray-400">Contact us within 48 hours of delivery with photos of the damaged item and packaging. We'll send a replacement or issue a full refund.</p>
        </div>
      </div>
      
      <div class="mt-12 text-center">
        <button class="px-8 py-4 font-medium transition-all duration-300 border border-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-purple-600/20 hover:to-pink-600/20 hover:border-pink-500/30 hover:shadow-lg hover:shadow-pink-500/10">
          View All FAQs
        </button>
      </div>
    </section>
  </div>
</div>

<!-- Animated background elements -->
<div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 opacity-20">
  <div class="absolute top-0 left-0 w-64 h-64 bg-purple-600 rounded-full filter blur-3xl animate-float1"></div>
  <div class="absolute right-0 bg-pink-600 rounded-full top-1/3 w-96 h-96 filter blur-3xl animate-float2"></div>
  <div class="absolute bottom-0 bg-purple-500 rounded-full left-1/4 w-80 h-80 filter blur-3xl animate-float3"></div>
</div>

<style>
  @keyframes float1 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-50px, -50px) rotate(5deg); }
  }
  @keyframes float2 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(50px, 50px) rotate(-5deg); }
  }
  @keyframes float3 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(30px, -30px) rotate(10deg); }
  }
  @keyframes gradient-x {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  @keyframes text {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  .animate-float1 { animation: float1 15s ease-in-out infinite; }
  .animate-float2 { animation: float2 20s ease-in-out infinite; }
  .animate-float3 { animation: float3 25s ease-in-out infinite; }
  .animate-gradient-x { 
    background-size: 200% 200%;
    animation: gradient-x 8s ease infinite; 
  }
  .animate-text { 
    background-size: 200%;
    animation: text 5s ease infinite; 
  }
</style>
@endsection