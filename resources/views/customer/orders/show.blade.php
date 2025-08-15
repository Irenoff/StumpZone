@extends('customer.layouts.app')
@section('title', 'Order Details · StumpZone')

@section('content')
@php
  // prefer controller-provided $items; fall back to relation if needed
  $lineItems = isset($items) ? $items : ($order->items ?? collect());
  $itemsTotal = $itemsTotal ?? ($lineItems ? $lineItems->sum(fn($i) => (float)($i->line_total ?? (($i->quantity ?? 0) * ($i->unit_price ?? 0)))) : 0);

  // normalize statuses
  $orderStatus    = $order->status ?? 'processing';
  $deliveryStatus = $deliveryStatus ?? ($order->delivery->status ?? null);

  // badge palettes
  $badge = function ($status) {
      $s = strtolower((string)$status);
      return match ($s) {
          'delivered' => 'bg-emerald-900 text-emerald-300',
          'cancelled' => 'bg-rose-900 text-rose-300',
          'confirmed' => 'bg-yellow-900 text-yellow-300',
          'shipping', 'shipped' => 'bg-indigo-900 text-indigo-300',
          'processing', 'pending' => 'bg-blue-900 text-blue-300',
          default => 'bg-gray-800 text-gray-300',
      };
  };
@endphp

<div class="max-w-5xl px-4 py-8 mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">
      Order {{ $order->order_number ?? ('#'.$order->id) }}
    </h1>
    <a href="{{ route('customer.orders.index') }}"
       class="px-3 py-2 text-sm border rounded-lg bg-white/10 border-white/10 hover:bg-white/20">
      ← Back to Orders
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

  <div class="grid gap-6 md:grid-cols-3">
    {{-- Items --}}
    <div class="p-4 border rounded-xl bg-white/5 border-white/10 md:col-span-2">
      <h2 class="mb-3 text-lg font-semibold text-white">Items</h2>

      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead class="text-xs text-gray-300 uppercase bg-white/5">
            <tr>
              <th class="px-4 py-2 text-left">Name</th>
              <th class="px-4 py-2 text-left">Sport</th>
              <th class="px-4 py-2 text-left">Qty</th>
              <th class="px-4 py-2 text-left">Unit Price</th>
              <th class="px-4 py-2 text-left">Subtotal</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/10">
            @forelse($lineItems as $it)
              @php
                $name  = $it->name ?? ('Item #'.$it->item_id);
                $sport = $it->display_sport ?? ($it->sport_type ?? '—');
                $qty   = (int) ($it->quantity ?? 0);
                $unit  = (float) ($it->unit_price ?? $it->price ?? 0);
                $sub   = (float) ($it->line_total ?? $it->subtotal ?? ($qty * $unit));
              @endphp
              <tr>
                <td class="px-4 py-2 text-white">{{ $name }}</td>
                <td class="px-4 py-2 text-gray-300">{{ $sport }}</td>
                <td class="px-4 py-2 text-gray-300">{{ $qty }}</td>
                <td class="px-4 py-2 text-gray-300">Rs. {{ number_format($unit, 2) }}</td>
                <td class="px-4 py-2 text-white">Rs. {{ number_format($sub, 2) }}</td>
              </tr>
            @empty
              <tr><td colspan="5" class="px-4 py-4 text-center text-gray-400">No items</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="flex justify-end mt-4">
        <div class="w-full max-w-sm p-4 border rounded-xl bg-white/5 border-white/10">
          <div class="flex justify-between text-sm text-gray-300">
            <span>Items Total</span>
            <span>Rs. {{ number_format($itemsTotal ?? ($order->items_total ?? 0), 2) }}</span>
          </div>
          <div class="flex justify-between mt-2 text-sm text-gray-300">
            <span>Delivery ({{ ucfirst($order->delivery_method ?? 'standard') }})</span>
            <span>Rs. {{ number_format($order->delivery_fee ?? 0, 2) }}</span>
          </div>
          <div class="flex justify-between mt-3 text-base font-semibold text-white">
            <span>Grand Total</span>
            <span>
              Rs. {{
                number_format(
                  $order->grand_total
                    ?? (($itemsTotal ?? ($order->items_total ?? 0)) + ($order->delivery_fee ?? 0)),
                  2
                )
              }}
            </span>
          </div>
        </div>
      </div>
    </div>

    {{-- Side column --}}
    <div class="space-y-6">
      {{-- Overall Order Status --}}
      <div class="p-4 border rounded-xl bg-white/5 border-white/10">
        <h2 class="mb-3 text-lg font-semibold text-white">Order Status</h2>
        <div class="inline-block px-2 py-1 text-xs rounded {{ $badge($orderStatus) }}">
          {{ ucfirst($orderStatus) }}
        </div>
        <p class="mt-2 text-sm text-gray-300">
          {{ $order->processing_message ?? 'We received your order and will start processing shortly.' }}
        </p>
      </div>

      {{-- Delivery Status --}}
      <div class="p-4 border rounded-xl bg-white/5 border-white/10">
        <h2 class="mb-3 text-lg font-semibold text-white">Delivery</h2>
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-300">Status:</span>
          <span class="px-2 py-1 text-xs rounded {{ $badge($deliveryStatus ?? 'pending') }}">
            {{ ucfirst($deliveryStatus ?? 'pending') }}
          </span>
        </div>
        <div class="mt-2 text-sm text-gray-300">
          <div><span class="text-gray-400">Method:</span> {{ ucfirst($order->delivery_method ?? 'standard') }}</div>
          <div class="mt-1"><span class="text-gray-400">Address:</span> {{ $order->customer_address ?? '—' }}</div>
          <div class="mt-1"><span class="text-gray-400">Email:</span> {{ $order->customer_email ?? '—' }}</div>
        </div>
      </div>

      {{-- Placed --}}
      <div class="p-4 border rounded-xl bg-white/5 border-white/10">
        <h2 class="mb-3 text-lg font-semibold text-white">Placed</h2>
        <div class="text-sm text-gray-300">
          {{ $order->created_at?->format('M d, Y H:i') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
