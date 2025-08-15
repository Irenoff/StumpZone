@extends('customer.layouts.app')
@section('title', 'My Orders · StumpZone')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">My Orders</h1>
    <a href="{{ url('/shop/sport/cricket') }}" class="px-4 py-2 text-sm font-medium bg-blue-600 rounded-md hover:bg-blue-700">
      Shop More
    </a>
  </div>

  @if(session('success'))
    <div class="p-3 mb-4 border rounded bg-emerald-500/10 border-emerald-500/30 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="p-3 mb-4 border rounded bg-rose-500/10 border-rose-500/30 text-rose-200">
      {{ session('error') }}
    </div>
  @endif

  @if(($orders->count() ?? 0) === 0)
    <div class="p-6 text-center bg-gray-800 border border-gray-700 rounded-lg">
      <p class="mb-3 text-gray-300">No orders found</p>
      <a href="{{ url('/shop/sport/cricket') }}" class="inline-block px-4 py-2 text-sm bg-blue-600 rounded-md hover:bg-blue-700">
        Browse Equipment
      </a>
    </div>
  @else
    <div class="overflow-hidden bg-gray-800 border border-gray-700 rounded-lg">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-900">
          <tr>
            <th class="px-6 py-3 text-xs font-medium text-left text-gray-400 uppercase">Order #</th>
            <th class="px-6 py-3 text-xs font-medium text-left text-gray-400 uppercase">Date</th>
            <th class="px-6 py-3 text-xs font-medium text-left text-gray-400 uppercase">Equipment</th>
            <th class="px-6 py-3 text-xs font-medium text-left text-gray-400 uppercase">Status</th>
            <th class="px-6 py-3 text-xs font-medium text-right text-gray-400 uppercase">Total</th>
            <th class="px-6 py-3 text-xs font-medium text-right text-gray-400 uppercase"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
          @foreach ($orders as $o)
            <tr class="hover:bg-gray-900/50">
              <td class="px-6 py-4 text-sm font-medium text-white whitespace-nowrap">
                {{ $o->order_number ?? ('#'.$o->id) }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                {{ $o->created_at?->format('M d, Y H:i') }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-300">
                <div class="flex flex-wrap gap-1">
                  @forelse ($o->items as $it)
                    <span class="px-2 py-1 text-xs bg-gray-700 rounded">
                      {{ $it->name ?? ('Item #'.$it->item_id) }} (x{{ $it->quantity }})
                    </span>
                  @empty
                    <span class="text-xs text-gray-400">No items</span>
                  @endforelse
                </div>
              </td>
              <td class="px-6 py-4 text-sm whitespace-nowrap">
                @if($o->status === 'delivered')
                  <span class="px-2 py-1 text-xs text-green-300 rounded bg-green-600/20">Delivered</span>
                @elseif($o->status === 'cancelled')
                  <span class="px-2 py-1 text-xs text-red-300 rounded bg-red-600/20">Cancelled</span>
                @elseif($o->status === 'confirmed')
                  <span class="px-2 py-1 text-xs text-yellow-300 rounded bg-yellow-600/20">Confirmed</span>
                @else
                  <span class="px-2 py-1 text-xs text-gray-300 rounded bg-gray-600/20">{{ ucfirst($o->status ?? 'Pending') }}</span>
                @endif
              </td>
              <td class="px-6 py-4 text-sm font-medium text-right text-white whitespace-nowrap">
                Rs. {{ number_format($o->grand_total ?? $o->total ?? 0, 2) }}
              </td>
              <td class="px-6 py-4 text-sm text-right">
                <a href="{{ route('customer.orders.show', $o->id) }}"
                   class="inline-block px-3 py-1.5 rounded bg-white/10 hover:bg-white/20">
                  View
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $orders->links() }}
    </div>
  @endif
</div>
@endsection
