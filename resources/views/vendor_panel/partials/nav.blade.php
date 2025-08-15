<nav class="sticky top-0 z-40 border-b backdrop-blur bg-white/5 border-white/10">
  <div class="flex items-center justify-between max-w-6xl px-6 py-3 mx-auto">
    <a href="{{ route('vendor.dashboard') }}" class="font-semibold">🏪 Vendor</a>
    <div class="flex gap-4 text-sm">
      <a href="{{ route('vendor.dashboard') }}" class="hover:underline">Dashboard</a>
      <a href="{{ route('vendor.products.home') }}" class="hover:underline">Products</a>
      <a href="{{ route('vendor.orders.index') }}" class="hover:underline">Orders</a>
      <form method="POST" action="{{ route('logout') }}">@csrf
        <button class="hover:underline">Logout</button>
      </form>
    </div>
  </div>
</nav>
