@php $app = config('app.name', 'StumpZone'); @endphp

<footer class="w-full border-t border-white/10 bg-gradient-to-b from-slate-900 to-slate-950 text-slate-200">
  <!-- Main footer content -->
  <div class="w-full px-6 py-16 mx-auto">
    <div class="mx-auto max-w-7xl">
      <!-- Top section - Brand and links -->
      <div class="grid gap-12 md:grid-cols-4 lg:gap-16">
        <!-- Brand column -->
        <div class="space-y-6">
          <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
            <span class="flex items-center justify-center w-12 h-12 text-xl transition-transform duration-300 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 group-hover:rotate-12">
              🏏
            </span>
            <span class="text-2xl font-bold text-white">{{ $app }}</span>
          </a>
          <p class="text-sm leading-relaxed text-slate-400">
            Elevating your game with premium sports gear and lightning-fast delivery across Sri Lanka.
          </p>
          
          <!-- Social links -->
          <div class="flex items-center gap-4 pt-2">
            <a href="#" class="p-2 transition-all rounded-full text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700">
              <span class="sr-only">Twitter</span>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
              </svg>
            </a>
            <a href="#" class="p-2 transition-all rounded-full text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700">
              <span class="sr-only">Instagram</span>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
              </svg>
            </a>
            <a href="#" class="p-2 transition-all rounded-full text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700">
              <span class="sr-only">Facebook</span>
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
              </svg>
            </a>
          </div>
        </div>

        <!-- Shop column -->
        <div>
          <h4 class="text-sm font-semibold tracking-wider uppercase text-slate-300">Shop</h4>
          <ul class="mt-6 space-y-3">
            <li>
              <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Shop Home
              </a>
            </li>
            <li>
              <a href="{{ route('customer.arrivals') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                New Arrivals
              </a>
            </li>
            <li>
              <a href="{{ route('customer.offers') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                </svg>
                Special Offers
              </a>
            </li>
            <li>
              <a href="{{ route('cart.view') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Your Cart
              </a>
            </li>
            <li>
              <a href="{{ route('customer.reviews') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                Customer Reviews
              </a>
            </li>
          </ul>
        </div>

        <!-- Sports column -->
        <div>
          <h4 class="text-sm font-semibold tracking-wider uppercase text-slate-300">Sports</h4>
          <ul class="mt-6 space-y-3">
            <li>
              <a href="{{ route('customer.cricket') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <span class="w-4 h-4 text-amber-500">🏏</span>
                Cricket
              </a>
            </li>
            <li>
              <a href="{{ route('customer.football') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <span class="w-4 h-4 text-amber-500">⚽</span>
                Football
              </a>
            </li>
            <li>
              <a href="{{ route('customer.basketball') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <span class="w-4 h-4 text-amber-500">🏀</span>
                Basketball
              </a>
            </li>
            <li>
              <a href="{{ route('customer.badminton') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <span class="w-4 h-4 text-amber-500">🏸</span>
                Badminton
              </a>
            </li>
            <li>
              <a href="{{ route('customer.boxing') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <span class="w-4 h-4 text-amber-500">🥊</span>
                Boxing
              </a>
            </li>
          </ul>
        </div>

        <!-- Support column -->
        <div>
          <h4 class="text-sm font-semibold tracking-wider uppercase text-slate-300">Support</h4>
          <ul class="mt-6 space-y-3">
            <li>
              <a href="{{ route('customer.delivery') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Delivery Info
              </a>
            </li>
            <li>
              <a href="{{ route('customer.branches') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Our Branches
              </a>
            </li>
            <li>
              <a href="{{ route('customer.contact') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Contact Us
              </a>
            </li>
            <li>
              <a href="{{ route('customer.about') }}" class="flex items-center gap-2 text-sm transition-colors text-slate-400 hover:text-amber-400">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                About Us
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Bottom section - Copyright and links -->
      <div class="flex flex-col items-center justify-between gap-6 pt-12 mt-12 border-t md:flex-row border-white/10">
        <!-- Copyright -->
        <div class="flex items-center gap-2">
          <span class="text-xs text-slate-500">© {{ date('Y') }} {{ $app }}. All rights reserved.</span>
          <a href="#" class="text-xs text-slate-500 hover:text-amber-400">Privacy Policy</a>
          <a href="#" class="text-xs text-slate-500 hover:text-amber-400">Terms of Service</a>
        </div>

        <!-- Payment methods -->
        <div class="flex items-center gap-4">
          <span class="text-xs text-slate-500">We accept:</span>
          <div class="flex items-center gap-2">
            <span class="flex items-center justify-center w-8 h-5 text-xs rounded bg-slate-800">VISA</span>
            <span class="flex items-center justify-center w-8 h-5 text-xs rounded bg-slate-800">MC</span>
            <span class="flex items-center justify-center w-8 h-5 text-xs rounded bg-slate-800">PP</span>
          </div>
        </div>

        <!-- Back to top -->
        <a href="#" class="flex items-center gap-1 text-xs text-slate-500 hover:text-amber-400">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
          </svg>
          Back to top
        </a>
      </div>
    </div>
  </div>
</footer>