{{-- resources/views/vendor_panel/dashboard.blade.php --}}
@extends('vendor_panel.layouts.app')
@section('title', 'Vendor • Dashboard')

@section('content')
  {{-- Page heading --}}
  <div class="mb-8">
    <div class="flex items-center gap-2">
      <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
      <span class="text-xs tracking-widest uppercase text-slate-400">Overview</span>
    </div>
    <div class="flex items-center justify-between mt-2">
      <h1 class="text-2xl font-bold md:text-3xl">Vendor • Dashboard</h1>
      <a href="{{ route('vendor.orders.index') }}"
         class="inline-flex items-center gap-2 px-4 py-2 border rounded-lg bg-slate-900 text-slate-100 border-white/10 hover:bg-slate-800">
        View Orders
      </a>
    </div>
  </div>

  {{-- Flash --}}
  @if(session('success'))
    <div class="px-4 py-3 mb-6 border rounded-xl border-emerald-400/30 bg-emerald-500/10 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  {{-- KPI cards --}}
  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="relative p-5 overflow-hidden border shadow-lg group rounded-2xl bg-gradient-to-br from-sky-500/15 to-cyan-400/10 border-white/10">
      <div class="text-sm text-sky-200/90">Total Orders</div>
      <div class="mt-2 text-4xl font-extrabold tracking-tight">{{ number_format($ordersCount ?? 0) }}</div>
      <div class="absolute w-24 h-24 rounded-full pointer-events-none -right-6 -bottom-6 bg-sky-400/10 blur-2xl"></div>
    </div>

    <div class="relative p-5 overflow-hidden border shadow-lg group rounded-2xl bg-gradient-to-br from-amber-500/15 to-yellow-400/10 border-white/10">
      <div class="text-sm text-amber-200/90">Customers</div>
      <div class="mt-2 text-4xl font-extrabold tracking-tight">{{ number_format($customersCount ?? 0) }}</div>
      <div class="absolute w-24 h-24 rounded-full pointer-events-none -right-6 -bottom-6 bg-amber-400/10 blur-2xl"></div>
    </div>

    <div class="relative p-5 overflow-hidden border shadow-lg group rounded-2xl bg-gradient-to-br from-violet-500/15 to-fuchsia-500/10 border-white/10">
      <div class="text-sm text-violet-200/90">Items Ordered</div>
      <div class="mt-2 text-4xl font-extrabold tracking-tight">{{ number_format($itemsOrderedSum ?? 0) }}</div>
      <div class="absolute w-24 h-24 rounded-full pointer-events-none -right-6 -bottom-6 bg-violet-400/10 blur-2xl"></div>
    </div>

    <div class="relative p-5 overflow-hidden border shadow-lg group rounded-2xl bg-gradient-to-br from-emerald-500/15 to-teal-400/10 border-white/10">
      <div class="text-sm text-emerald-200/90">Products in Store</div>
      <div class="mt-2 text-4xl font-extrabold tracking-tight">
        {{ number_format(($productsTotal ?? $productsCount) ?? 0) }}
      </div>
      <div class="absolute w-24 h-24 rounded-full pointer-events-none -right-6 -bottom-6 bg-emerald-400/10 blur-2xl"></div>
    </div>
  </div>

  {{-- Actions --}}
  <div class="flex gap-3 mt-6">
    <a href="{{ route('vendor.orders.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-white shadow rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700">
      Manage Orders
    </a>
    <a href="{{ route('vendor.products.home') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-white shadow rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700">
      Manage stuffs
    </a>
  </div>

  {{-- Report Download --}}
  <div class="mt-6">
    <a href="{{ route('vendor.orders.report.today') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-white shadow rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700">
      Download Today's Orders Report
    </a>
  </div>

  {{-- Recent Orders --}}
  <div class="mt-8 overflow-hidden border shadow-xl rounded-2xl border-white/10 bg-slate-900/60 backdrop-blur-lg">
    <div class="px-4 py-3 text-sm font-semibold border-b text-slate-200 border-white/10">Recent Orders</div>
    <table class="min-w-full">
      <thead class="text-xs tracking-wide uppercase text-slate-300 bg-slate-800/60">
        <tr>
          <th class="px-4 py-3 text-left">Order #</th>
          <th class="px-4 py-3 text-left">Customer</th>
          <th class="px-4 py-3 text-left">Placed</th>
          <th class="px-4 py-3 text-right">Grand Total</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/10">
        @php
          $badge = [
            'processing' => 'bg-blue-500/15 text-blue-200 ring-1 ring-inset ring-blue-400/30',
            'confirmed'  => 'bg-sky-500/15 text-sky-200 ring-1 ring-inset ring-sky-400/30',
            'shipping'   => 'bg-indigo-500/15 text-indigo-200 ring-1 ring-inset ring-indigo-400/30',
            'delivered'  => 'bg-emerald-500/15 text-emerald-200 ring-1 ring-inset ring-emerald-400/30',
            'cancelled'  => 'bg-rose-500/15 text-rose-200 ring-1 ring-inset ring-rose-400/30',
          ];
        @endphp

        @forelse($recentOrders ?? [] as $o)
          <tr class="transition-colors hover:bg-white/5">
            <td class="px-4 py-3 font-semibold text-white">#{{ $o->order_number ?? $o->id }}</td>
            <td class="px-4 py-3 text-slate-300">
              <div>{{ $o->customer_email ?? '—' }}</div>
              <div class="text-xs text-slate-400">{{ $o->customer_address ?? '' }}</div>
            </td>
            <td class="px-4 py-3 text-slate-300">{{ optional($o->created_at)->format('Y-m-d H:i') }}</td>
            <td class="px-4 py-3 text-right text-emerald-300">Rs. {{ number_format($o->grand_total ?? $o->total ?? 0, 2) }}</td>
            <td class="px-4 py-3">
              @php $cls = $badge[$o->status ?? 'processing'] ?? 'bg-slate-600/30 text-slate-200'; @endphp
              <span class="px-2.5 py-1 text-xs rounded-full {{ $cls }}">
                {{ ucfirst($o->status ?? 'processing') }}
              </span>
            </td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('vendor.orders.show', $o->id) }}"
                 class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white">
                View
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="px-4 py-6 text-center text-slate-400">No recent orders</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
