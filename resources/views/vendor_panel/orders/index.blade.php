@extends('vendor_panel.layouts.app')
@section('title','Vendor • Orders')

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold text-white">Orders</h1>
  </div>

  @if(session('success'))
    <div class="p-3 text-sm text-green-200 border rounded bg-green-900/30 border-green-500/20">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="p-3 text-sm text-red-200 border rounded bg-red-900/30 border-red-500/20">
      {{ session('error') }}
    </div>
  @endif

  <div class="p-4 border rounded-xl bg-white/5 border-white/10">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="text-left text-white bg-white/10">
          <tr>
            <th class="px-3 py-2">#</th>
            <th class="px-3 py-2">Order No</th>
            <th class="px-3 py-2">Status</th>
            <th class="px-3 py-2 text-right">Total</th>
            <th class="px-3 py-2">Placed</th>
            <th class="px-3 py-2 text-center">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-200 divide-y divide-white/10">
          @forelse($orders as $o)
            <tr>
              <td class="px-3 py-2">#{{ $o->id }}</td>
              <td class="px-3 py-2">{{ $o->order_number ?? '—' }}</td>
              <td class="px-3 py-2">{{ $o->status ?? '—' }}</td>
              <td class="px-3 py-2 text-right">
                @php
                  $gt = $o->grand_total ?? $o->total ?? null;
                @endphp
                {{ $gt !== null ? number_format((float)$gt,2) : '—' }}
              </td>
              <td class="px-3 py-2">{{ $o->created_at ?? '—' }}</td>
              <td class="px-3 py-2 text-center">
                <a class="px-3 py-1 text-xs rounded bg-white/10 hover:bg-white/20"
                   href="{{ route('vendor.orders.show', $o->id) }}">
                   View
                </a>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="px-3 py-6 text-center text-gray-400">No orders found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $orders->links() }}
    </div>
  </div>
</div>
@endsection
