@extends('customer.layouts.app')

@section('content')
<div class="min-h-screen px-4 py-10 bg-gradient-to-b from-gray-950 to-gray-900 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        {{-- Header --}}
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 mb-6 border rounded-2xl bg-gradient-to-br from-pink-500/20 to-purple-500/20 border-white/10 backdrop-blur">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4
                             M7 13L5.4 5M7 13l-2.293 2.293
                             c-.63.63-.184 1.707.707 1.707H17
                             m0 0a2 2 0 100 4 2 2 0 000-4
                             zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-black tracking-tight text-white sm:text-5xl">
                My <span class="text-transparent bg-gradient-to-r from-pink-400 via-fuchsia-400 to-purple-400 bg-clip-text">Shopping Cart</span>
            </h1>
            <p class="mt-3 text-gray-300 sm:text-lg">Review, update, and checkout securely</p>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="p-4 mb-6 border rounded-xl border-emerald-500/40 bg-emerald-500/10 text-emerald-100">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-6 border rounded-xl border-rose-500/40 bg-rose-500/10 text-rose-100">
                {{ session('error') }}
            </div>
        @endif

        {{-- Inline boxes --}}
        <div id="cartErrorBox" class="hidden p-4 mb-6 border rounded-xl border-rose-500/40 bg-rose-500/10 text-rose-100" aria-live="polite"></div>

        {{-- Normalize items safely (works for arrays or objects) --}}
        @php
            $itemsCollection = collect($items ?? []);
        @endphp

        @if($itemsCollection->count() > 0)
            @php
                $grandTotal = $itemsCollection->sum(function ($it) {
                    return is_object($it) ? ($it->subtotal ?? 0)
                         : (is_array($it) ? ($it['subtotal'] ?? 0) : 0);
                });
            @endphp

            {{-- MOBILE — Card list --}}
            <div class="space-y-5 lg:hidden">
                @foreach($itemsCollection as $item)
                    @php
                        $id    = is_object($item) ? $item->id : ($item['id'] ?? null);
                        $name  = is_object($item) ? $item->name : ($item['name'] ?? '');
                        $sport = is_object($item) ? $item->sport_type : ($item['sport_type'] ?? '');
                        $size  = is_object($item) ? $item->size : ($item['size'] ?? '');
                        $price = is_object($item) ? $item->price : ($item['price'] ?? 0);
                        $qty   = is_object($item) ? $item->quantity : ($item['quantity'] ?? 1);
                        $sub   = is_object($item) ? $item->subtotal : ($item['subtotal'] ?? 0);
                        $img   = is_object($item) ? ($item->image_path ?? null) : ($item['image_path'] ?? null);
                        $stock = (int) (is_object($item) ? ($item->stock ?? 0) : ($item['stock'] ?? 0));
                    @endphp
                    <div class="p-4 border shadow-xl rounded-2xl bg-white/5 border-white/10 backdrop-blur"
                         data-item-row data-item-id="{{ $id }}">
                        <div class="flex items-start gap-4">
                            <input
                                type="checkbox"
                                value="{{ $id }}"
                                class="w-5 h-5 mt-2 bg-gray-800 border-gray-600 rounded-md text-fuchsia-500 focus:ring-fuchsia-400 item-select"
                                aria-label="Select {{ $name }}"
                                data-id="{{ $id }}"
                            >
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}"
                                     alt="{{ $name }}"
                                     class="object-cover w-20 h-20 rounded-xl ring-1 ring-white/10">
                            @endif

                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-semibold leading-6 text-white">{{ $name }}</h3>
                                        <div class="flex flex-wrap items-center gap-2 mt-1 text-sm">
                                            <span class="px-2.5 py-1 rounded-lg bg-fuchsia-500/10 text-fuchsia-200 border border-fuchsia-400/20">
                                                {{ ucfirst($sport) }}
                                            </span>
                                            <span class="text-gray-400">Size: {{ $size }}</span>
                                            <span class="px-2.5 py-1 rounded-lg border border-emerald-400/20 bg-emerald-500/10 text-emerald-200">
                                                In stock: {{ $stock }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Remove --}}
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-rose-400 hover:text-rose-300 hover:bg-white/5">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="grid grid-cols-2 gap-3 mt-4">
                                    <div>
                                        <div class="text-xs text-gray-400">Price</div>
                                        <div class="font-bold text-emerald-400">{{ number_format($price, 2) }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs text-gray-400">Subtotal</div>
                                        <div class="font-bold text-white"> {{ number_format($sub, 2) }}</div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="block mb-1 text-xs text-gray-400" for="qty-m-{{ $id }}">Quantity</label>
                                    <input
                                        id="qty-m-{{ $id }}"
                                        type="number"
                                        min="1"
                                        max="{{ $stock }}"
                                        value="{{ $qty }}"
                                        data-id="{{ $id }}"
                                        data-stock="{{ $stock }}"
                                        data-name="{{ $name }}"
                                        class="w-24 px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg qty-input focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400"
                                    >
                                    <p data-role="qty-error" class="hidden mt-1 text-sm text-rose-300"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- DESKTOP — Table --}}
            <div class="hidden lg:block">
                <div class="overflow-hidden border shadow-2xl rounded-2xl bg-white/5 border-white/10 backdrop-blur">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="text-sm tracking-wider text-gray-300 uppercase bg-white/5">
                                <tr>
                                    <th class="px-6 py-4 text-left">Select</th>
                                    <th class="px-6 py-4 text-left">Item</th>
                                    <th class="px-6 py-4 text-left">Sport</th>
                                    <th class="px-6 py-4 text-left">Size</th>
                                    <th class="px-6 py-4 text-left">Stock</th>
                                    <th class="px-6 py-4 text-left">Price</th>
                                    <th class="px-6 py-4 text-left">Qty</th>
                                    <th class="px-6 py-4 text-left">Subtotal</th>
                                    <th class="px-6 py-4 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @foreach($itemsCollection as $item)
                                    @php
                                        $id    = is_object($item) ? $item->id : ($item['id'] ?? null);
                                        $name  = is_object($item) ? $item->name : ($item['name'] ?? '');
                                        $sport = is_object($item) ? $item->sport_type : ($item['sport_type'] ?? '');
                                        $size  = is_object($item) ? $item->size : ($item['size'] ?? '');
                                        $price = is_object($item) ? $item->price : ($item['price'] ?? 0);
                                        $qty   = is_object($item) ? $item->quantity : ($item['quantity'] ?? 1);
                                        $sub   = is_object($item) ? $item->subtotal : ($item['subtotal'] ?? 0);
                                        $img   = is_object($item) ? ($item->image_path ?? null) : ($item['image_path'] ?? null);
                                        $stock = (int) (is_object($item) ? ($item->stock ?? 0) : ($item['stock'] ?? 0));
                                    @endphp
                                    <tr class="hover:bg-white/5" data-item-row data-item-id="{{ $id }}">
                                        <td class="px-6 py-4">
                                            <input
                                                type="checkbox"
                                                value="{{ $id }}"
                                                class="w-5 h-5 bg-gray-800 border-gray-600 rounded-md item-select text-fuchsia-500 focus:ring-fuchsia-400"
                                                aria-label="Select {{ $name }}"
                                                data-id="{{ $id }}"
                                            >
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                @if($img)
                                                    <img src="{{ asset('storage/' . $img) }}"
                                                         alt="{{ $name }}"
                                                         class="object-cover w-16 h-16 rounded-xl ring-1 ring-white/10">
                                                @endif
                                                <span class="font-semibold text-white">{{ $name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-300">{{ ucfirst($sport) }}</td>
                                        <td class="px-6 py-4 text-gray-300">{{ $size }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 rounded-lg border border-emerald-400/20 bg-emerald-500/10 text-emerald-200">
                                                {{ $stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-emerald-400"> {{ number_format($price, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <input
                                                type="number"
                                                min="1"
                                                max="{{ $stock }}"
                                                value="{{ $qty }}"
                                                data-id="{{ $id }}"
                                                data-stock="{{ $stock }}"
                                                data-name="{{ $name }}"
                                                class="w-24 px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg qty-input focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400"
                                            >
                                            <p data-role="qty-error" class="hidden mt-1 text-sm text-rose-300"></p>
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-white">{{ number_format($sub, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-2 rounded-lg text-rose-400 hover:text-rose-300 hover:bg-white/5">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Delivery Options --}}
            <div class="mt-8">
                <h3 class="mb-3 text-sm font-semibold text-gray-300">Delivery Options</h3>
                <div id="deliveryGroup" class="grid gap-3 sm:grid-cols-3">
                    <label class="flex items-center justify-between gap-3 p-3 border cursor-pointer rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                        <span class="flex items-center gap-2 text-white">
                            <input type="radio" name="delivery_choice" value="standard" data-fee="2.99" class="w-5 h-5 text-fuchsia-500 focus:ring-fuchsia-400" checked>
                            <span>Standard (2–5 days)</span>
                        </span>
                        <span class="font-semibold text-emerald-400">Rs 750.00</span>
                    </label>

                    <label class="flex items-center justify-between gap-3 p-3 border cursor-pointer rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                        <span class="flex items-center gap-2 text-white">
                            <input type="radio" name="delivery_choice" value="express" data-fee="5.99" class="w-5 h-5 text-fuchsia-500 focus:ring-fuchsia-400">
                            <span>Express (1–2 days)</span>
                        </span>
                        <span class="font-semibold text-emerald-400">Rs 1500.00</span>
                    </label>

                    <label class="flex items-center justify-between gap-3 p-3 border cursor-pointer rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                        <span class="flex items-center gap-2 text-white">
                            <input type="radio" name="delivery_choice" value="overnight" data-fee="2400.00" class="w-5 h-5 text-fuchsia-500 focus:ring-fuchsia-400">
                            <span>Overnight</span>
                        </span>
                        <span class="font-semibold text-emerald-400">Rs 2400.00</span>
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-400">
                    The selected delivery charge will be added on the payment page.
                </p>
            </div>

            {{-- Bottom bar --}}
            <div class="flex flex-col-reverse gap-4 mt-8 sm:flex-row sm:items-center sm:justify-between">
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear your entire cart?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-3 text-gray-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862A2 2 0 015.867 19.142L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Clear Cart
                    </button>
                </form>

                <div class="flex items-center justify-between sm:justify-end sm:gap-6">
                    <div class="text-lg font-semibold text-white">
                        Total: <span class="text-emerald-400">Rs {{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <button
                        id="proceedBtn"
                        type="button"
                        class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white shadow-lg rounded-xl bg-gradient-to-r from-pink-500 via-fuchsia-500 to-purple-500 hover:brightness-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Proceed to Payment
                    </button>
                </div>
            </div>

            {{-- Hidden checkout form --}}
            <form id="checkoutForm" action="{{ route('customer.cart.payment') }}" method="GET" class="hidden"></form>

        @else
            {{-- Empty state --}}
            <div class="py-16 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-6 border rounded-2xl bg-white/5 border-white/10">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4
                                 M7 13L5.4 5M7 13l-2.293 2.293
                                 c-.63.63-.184 1.707.707 1.707H17
                                 m0 0a2 2 0 100 4 2 2 0 000-4
                                 zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white">Your cart is empty</h3>
                <p class="mt-2 text-gray-400">Start shopping to add items to your cart.</p>
                <div class="mt-6">
                    <a href="{{ route('customer.badminton') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white shadow-lg rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:brightness-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const proceedBtn   = document.getElementById('proceedBtn');
    const checkoutForm = document.getElementById('checkoutForm');
    const errorBox     = document.getElementById('cartErrorBox');

    function clearBox(box){
        box.classList.add('hidden');
        box.innerHTML = '';
    }
    function showList(box, messages){
        if (!messages.length) return;
        const ul = document.createElement('ul');
        ul.className = 'list-disc pl-5 space-y-1';
        messages.forEach(m => {
            const li = document.createElement('li');
            li.textContent = m;
            ul.appendChild(li);
        });
        box.appendChild(ul);
        box.classList.remove('hidden');
    }

    function clearDynamicFields() {
        checkoutForm.querySelectorAll('.dyn-field').forEach(el => el.remove());
    }
    function appendHidden(name, value) {
        const input = document.createElement('input');
        input.type  = 'hidden';
        input.name  = name;
        input.value = value;
        input.className = 'dyn-field';
        checkoutForm.appendChild(input);
    }

    function getRowErrorEl(qInput){
        const row = qInput.closest('[data-item-row]');
        return row ? row.querySelector('[data-role="qty-error"]') : null;
    }
    function setFieldError(qInput, msg) {
        const p = getRowErrorEl(qInput);
        qInput.classList.add('border-rose-500', 'focus:ring-rose-400', 'focus:border-rose-400');
        if (p) {
            p.textContent = msg;
            p.classList.remove('hidden');
        }
    }
    function clearFieldError(qInput) {
        const p = getRowErrorEl(qInput);
        qInput.classList.remove('border-rose-500','focus:ring-rose-400','focus:border-rose-400');
        if (p) {
            p.textContent = '';
            p.classList.add('hidden');
        }
    }

    function uniqueVisibleById(nodeList) {
        const map = new Map();
        nodeList.forEach(el => {
            const id = el.dataset.id;
            if (!id) return;
            const visible = !!(el.offsetParent !== null);
            if (!map.has(id)) {
                map.set(id, el);
            } else if (visible) {
                map.set(id, el);
            }
        });
        return Array.from(map.values());
    }

    function handleProceed() {
        clearBox(errorBox);

        const qtyInputsAll  = uniqueVisibleById(document.querySelectorAll('.qty-input'));
        const checkboxesAll = uniqueVisibleById(document.querySelectorAll('.item-select'));

        const checked = checkboxesAll.filter(cb => cb.checked);
        if (checked.length === 0) {
            showList(errorBox, ['Select at least one item to proceed.']);
            return;
        }

        const chosenIds = new Set(checked.map(cb => cb.value));
        const qtyInputs = qtyInputsAll.filter(q => chosenIds.has(q.dataset.id));

        const errors = [];
        let hasHardError = false;

        qtyInputs.forEach(q => {
            const name  = q.dataset.name || 'This item';
            const stock = parseInt(q.dataset.stock || '0', 10);
            let qty     = parseInt(q.value || '1', 10);

            clearFieldError(q);

            if (stock <= 0) {
                q.value = 1;
                setFieldError(q, `${name} is out of stock.`);
                errors.push(`${name} is out of stock.`);
                hasHardError = true;
                return;
            }

            if (Number.isNaN(qty) || qty < 1) {
                q.value = 1;
                setFieldError(q, `${name}: quantity must be at least 1.`);
                errors.push(`${name}: quantity must be at least 1.`);
                hasHardError = true;
                return;
            }

            if (qty > stock) {
                q.value = 1;
                setFieldError(q, `${name}: only ${stock} in stock.`);
                errors.push(`${name}: only ${stock} in stock.`);
                hasHardError = true;
                return;
            }
        });

        if (hasHardError) {
            showList(errorBox, errors);
            return;
        }

        clearDynamicFields();

        // selected[] (product/equipment or cart ids as your backend expects)
        chosenIds.forEach(id => appendHidden('selected[]', id));

        // quantities[id]
        qtyInputs.forEach(q => {
            const id = q.dataset.id;
            appendHidden(`quantities[${id}]`, q.value || 1);
        });

        // delivery choice
        const d = document.querySelector('input[name="delivery_choice"]:checked');
        if (d) {
            appendHidden('delivery_method', d.value);
            appendHidden('delivery_fee', d.dataset.fee || '0');
        }

        checkoutForm.submit();
    }

    if (proceedBtn) {
        proceedBtn.addEventListener('click', handleProceed);
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            handleProceed();
        }
    });

    uniqueVisibleById(document.querySelectorAll('.item-select')).forEach(cb => {
        cb.addEventListener('change', () => {
            if (!cb.checked) {
                const row = document.querySelector(`[data-item-row][data-item-id="${cb.dataset.id}"]`);
                if (row) {
                    const q = row.querySelector('.qty-input');
                    if (q) clearFieldError(q);
                }
            }
        });
    });
});
</script>
@endsection
