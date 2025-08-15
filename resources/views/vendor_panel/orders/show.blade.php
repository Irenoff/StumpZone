{{-- resources/views/vendor_panel/orders/show.blade.php --}}
@extends('vendor_panel.layouts.app')
@section('title', 'Vendor • Order #'.($order->id ?? ''))

@section('content')
@php
  // status + confirm availability
  $status = strtolower((string)($order->status ?? ''));
  $finalStatuses = ['confirmed','delivered','cancelled'];
  $canConfirm = !in_array($status, $finalStatuses, true) || $status === '';

  // Normalize items from controller or from JSON on the order
  $rawItems = $items ?? null;
  if (empty($rawItems)) {
      $rawItems = is_string($order->items ?? null)
          ? json_decode($order->items, true)
          : ($order->items ?? []);
  }

  // Helper to read from mixed array|object items
  $val = function ($it, $key, $default = null) {
      if (is_array($it)) return $it[$key] ?? $default;
      return $it->$key ?? $default;
  };

  // Compute totals (fallback if items_total is missing)
  $itemsTotal = (float)($order->items_total ?? 0);
  if ($itemsTotal <= 0 && !empty($rawItems)) {
      $itemsTotal = collect($rawItems)->reduce(function($carry, $it) use ($val) {
          $qty   = (int) $val($it, 'quantity', $val($it, 'qty', 1));
          $price = (float)$val($it, 'price', $val($it, 'unit_price', $val($it, 'amount', 0)));
          return $carry + ($qty * $price);
      }, 0.0);
  }
  $deliveryFee = (float)($order->delivery_fee ?? 0);
  $grand       = (float)($order->grand_total ?? ($itemsTotal + $deliveryFee));

  // Lookup map for sport tables
  $sportTable = [
      'cricket'    => 'cricket_equipment',
      'football'   => 'football_equipment',
      'basketball' => 'basketball_equipment',
      'badminton'  => 'badminton_equipment',
      'boxing'     => 'boxing_equipment',
  ];

  // Resolve a friendly product name for a row
  $resolveName = function ($it) use ($val, $sportTable, $order) {
      // direct fields first
      $name = $val($it, 'name',
               $val($it, 'product_name',
               $val($it, 'product_title')));

      if ($name) return $name;

      $sport = strtolower((string) $val($it, 'sport_type', $order->sport_type ?? ''));
      $eqId  = $val($it, 'equipment_id', $val($it, 'product_id'));

      try {
          if ($eqId && $sport && isset($sportTable[$sport])) {
              $row = DB::table($sportTable[$sport])->where('id', $eqId)->first();
              if ($row) {
                  // common name/title columns across your tables
                  return $row->name ?? $row->title ?? $row->product_name ?? '—';
              }
          }
          if ($eqId) {
              $row = DB::table('products')->where('id', $eqId)->first();
              if ($row) return $row->name ?? $row->title ?? '—';
          }
      } catch (\Throwable $e) {
          // swallow lookup errors and just show a dash
      }
      return '—';
  };
@endphp

<div class="max-w-6xl px-4 py-10 mx-auto space-y-6">

  {{-- Flash --}}
  @if (session('success'))
    <div class="p-3 text-sm text-green-200 border rounded bg-green-900/30 border-green-500/20">
      {{ session('success') }}
    </div>
  @endif
  @if (session('error'))
    <div class="p-3 text-sm text-red-200 border rounded bg-red-900/30 border-red-500/20">
      {{ session('error') }}
    </div>
  @endif

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold text-white">Order #{{ $order->id }}</h1>

    <div class="flex items-center gap-2">
      @if (!empty($order->status))
        <span class="px-2 py-1 text-xs text-gray-200 border rounded border-white/10 bg-white/5">
          Status: {{ $order->status }}
        </span>
      @endif

      <form method="POST" action="{{ route('vendor.orders.confirm', $order->id) }}">
        @csrf
        <button
          type="submit"
          @if(!$canConfirm) disabled @endif
          class="px-3 py-2 text-xs font-medium rounded-lg text-white
                 {{ $canConfirm ? 'bg-green-600 hover:bg-green-700' : 'bg-green-600/40 cursor-not-allowed' }}"
          onclick="return confirm('Confirm this order and send to Delivery?')"
        >
          Confirm
        </button>
      </form>
    </div>
  </div>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    {{-- Order Info --}}
    <div class="p-4 border rounded-xl bg-white/5 border-white/10">
      <h2 class="mb-3 font-semibold text-white">Order Info</h2>
      <dl class="space-y-2 text-sm text-gray-300">
        <div class="flex justify-between"><dt>ID</dt><dd>#{{ $order->id }}</dd></div>

        @if (!empty($order->order_number))
          <div class="flex justify-between"><dt>Order No.</dt><dd>{{ $order->order_number }}</dd></div>
        @endif

        @if (!empty($order->created_at))
          <div class="flex justify-between"><dt>Created</dt><dd>{{ $order->created_at }}</dd></div>
        @endif

        @if (!empty($order->delivery_method))
          <div class="flex justify-between"><dt>Delivery Method</dt><dd>{{ $order->delivery_method }}</dd></div>
        @endif

        <div class="flex justify-between"><dt>Items Total</dt><dd>{{ number_format($itemsTotal,2) }}</dd></div>
        <div class="flex justify-between"><dt>Delivery Fee</dt><dd>{{ number_format($deliveryFee,2) }}</dd></div>
        <div class="flex justify-between font-semibold text-white">
          <dt>Grand Total</dt><dd>{{ number_format($grand,2) }}</dd>
        </div>
      </dl>
    </div>

    {{-- Customer --}}
    <div class="p-4 border rounded-xl bg-white/5 border-white/10">
      <h2 class="mb-3 font-semibold text-white">Customer</h2>
      <dl class="space-y-2 text-sm text-gray-300">
        <div class="flex justify-between">
          <dt>Name</dt>
          <dd>{{ $order->customer_name ?? ($order->user_name ?? '—') }}</dd>
        </div>
        <div class="flex justify-between">
          <dt>Email</dt>
          <dd>{{ $order->customer_email ?? '—' }}</dd>
        </div>
        <div class="flex justify-between">
          <dt>Address</dt>
          <dd class="text-right max-w-[60%] whitespace-pre-line">{{ $order->customer_address ?? '—' }}</dd>
        </div>
      </dl>
    </div>
  </div>

  {{-- Items --}}
  <div class="p-4 border rounded-xl bg-white/5 border-white/10">
    <h2 class="mb-3 font-semibold text-white">Items</h2>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="text-left text-white bg-white/10">
          <tr>
            <th class="px-3 py-2">Product</th>
            <th class="px-3 py-2">Qty</th>
            <th class="px-3 py-2">Price</th>
            <th class="px-3 py-2">Subtotal</th>
          </tr>
        </thead>
        <tbody class="text-gray-200 divide-y divide-white/10">
          @forelse ($rawItems as $it)
            @php
              $name  = $resolveName($it);
              $qty   = (int) $val($it, 'quantity', $val($it, 'qty', 1));
              $price = (float)$val($it, 'price', $val($it, 'unit_price', $val($it, 'amount', 0)));
              $sub   = $qty * $price;
            @endphp
            <tr>
              <td class="px-3 py-2">{{ $name }}</td>
              <td class="px-3 py-2">{{ $qty }}</td>
              <td class="px-3 py-2">{{ number_format($price, 2) }}</td>
              <td class="px-3 py-2">{{ number_format($sub, 2) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-3 py-6 text-center text-gray-400">No items found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
