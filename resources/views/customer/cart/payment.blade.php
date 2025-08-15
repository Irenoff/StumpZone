@extends('customer.layouts.app')

@section('content')
<div class="max-w-5xl px-4 py-8 mx-auto text-white">
    <h1 class="mb-6 text-3xl font-bold">Payment</h1>

    {{-- Flash errors / success --}}
    @if(session('stock_errors') && count(session('stock_errors')))
        <div class="p-3 mb-4 rounded text-amber-900 bg-amber-200">
            <ul class="pl-6 space-y-1 list-disc">
                @foreach(session('stock_errors') as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="p-3 mb-4 text-red-900 bg-red-200 rounded">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="p-3 mb-4 rounded text-emerald-900 bg-emerald-200">{{ session('success') }}</div>
    @endif

    @php
        $deliveryMethod = old('delivery_method', $delivery_method ?? request('delivery_method', 'standard'));
        $deliveryFee    = (float) old('delivery_fee', $delivery_fee ?? request('delivery_fee', 0));
        $typedAmount    = old('amount', request('amount'));
        $grandWithDelivery = ($total ?? 0) + $deliveryFee;
    @endphp

    @if(!empty($items))
        <div class="mb-4 text-sm text-gray-300">
            You are paying for the selected items below.
        </div>

        <table class="w-full text-left border border-gray-700">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-4 py-2">Item</th>
                    <th class="px-4 py-2">Sport</th>
                    <th class="px-4 py-2">Size</th>
                    <th class="px-4 py-2">Unit Price</th>
                    <th class="px-4 py-2">Qty</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900">
                @foreach($items as $row)
                    <tr>
                        <td class="px-4 py-2">{{ $row->name }}</td>
                        <td class="px-4 py-2">{{ $row->sport_type }}</td>
                        <td class="px-4 py-2">{{ $row->size }}</td>
                        <td class="px-4 py-2">LKR {{ number_format($row->price, 2) }}</td>
                        <td class="px-4 py-2">{{ $row->quantity }}</td>
                        <td class="px-4 py-2">LKR {{ number_format($row->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-800">
                    <td colspan="5" class="px-4 py-2 text-right">Items total</td>
                    <td class="px-4 py-2">LKR {{ number_format($total, 2) }}</td>
                </tr>
                <tr class="bg-gray-800">
                    <td colspan="5" class="px-4 py-2 text-right">Delivery ({{ ucfirst($deliveryMethod) }})</td>
                    <td class="px-4 py-2">LKR {{ number_format($deliveryFee, 2) }}</td>
                </tr>
                <tr class="font-bold bg-green-700">
                    <td colspan="5" class="px-4 py-2 text-right">Grand Total</td>
                    <td class="px-4 py-2">LKR {{ number_format($grandWithDelivery, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Pay form --}}
        <form action="{{ route('checkout.pay') }}" method="POST" class="mt-6 space-y-4">
            @csrf

            {{-- Send the selected PRODUCT IDs (as received on payment page) --}}
            @foreach($selected as $id)
                <input type="hidden" name="selected[]" value="{{ (string) $id }}">
            @endforeach

            {{-- ALSO send the selected CART ROW IDs so backend can match either --}}
            @foreach($items as $row)
                <input type="hidden" name="selected_cart_ids[]" value="{{ (string) $row->cart_id }}">
            @endforeach

            {{-- Keep final quantities keyed by CART row id --}}
            @foreach($items as $row)
                <input type="hidden" name="quantities[{{ (string) $row->cart_id }}]" value="{{ (int) $row->quantity }}">
            @endforeach

            {{-- Delivery passthrough --}}
            <input type="hidden" name="delivery_method" value="{{ $deliveryMethod }}">
            <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">

            <div>
                <label for="amount" class="block mb-2 text-sm text-gray-300">
                    Enter amount to pay 
                </label>
                <input
                    id="amount"
                    name="amount"
                    type="number"
                    step="0.01"
                    min="0"
                    value="{{ $typedAmount }}"
                    class="px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg w-60 focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400"
                    placeholder="LKR {{ number_format($grandWithDelivery, 2) }}"
                    required
                >
                @error('amount')
                    <div class="mt-2 text-sm text-red-300">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2 font-semibold rounded bg-emerald-600 hover:bg-emerald-700">
                    Pay Now
                </button>

                <a href="{{ route('cart.view') }}"
                   class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">
                    Back to Cart
                </a>
            </div>
        </form>
    @else
        <p>No items to pay.</p>
    @endif
</div>
@endsection
