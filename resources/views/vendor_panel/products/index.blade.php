@extends('customer.layouts.app')
@section('title', 'Vendor • Products')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">Products</h1>
    <a href="{{ route('vendor.products.create', ['sport' => $sport]) }}" class="px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700">Add Item</a>
  </div>

  <form method="GET" class="mb-4">
    <label class="mr-2 text-sm text-gray-300">Sport:</label>
    <select name="sport" onchange="this.form.submit()" class="px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg">
      @foreach($sports as $s)
        <option value="{{ $s }}" @selected($sport===$s)>{{ ucfirst($s) }}</option>
      @endforeach
    </select>
  </form>

  @if(session('success'))
    <div class="p-3 mb-4 border rounded bg-emerald-500/10 border-emerald-500/30 text-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-hidden border rounded-xl bg-white/5 border-white/10">
    <table class="min-w-full">
      <thead class="text-sm text-gray-300 bg-white/5">
        <tr>
          <th class="px-4 py-3 text-left">Name</th>
          <th class="px-4 py-3 text-left">Size</th>
          <th class="px-4 py-3 text-right">Price</th>
          <th class="px-4 py-3 text-right">Stock</th>
          <th class="px-4 py-3"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/10">
        @foreach($items as $it)
        <tr class="hover:bg-white/5">
          <td class="px-4 py-3 text-white">{{ $it->name }}</td>
          <td class="px-4 py-3 text-gray-300">{{ $it->size ?? 'N/A' }}</td>
          <td class="px-4 py-3 text-right text-gray-300">Rs. {{ number_format($it->price, 2) }}</td>
          <td class="px-4 py-3 text-right text-gray-300">{{ $it->quantity }}</td>
          <td class="px-4 py-3 text-right">
            <a href="{{ route('vendor.products.edit', [$sport, $it->id]) }}" class="px-3 py-1.5 rounded bg-white/10 hover:bg-white/20">Edit</a>
            <form action="{{ route('vendor.products.destroy', [$sport, $it->id]) }}" method="POST" class="inline" onsubmit="return confirm('Delete item?')">
              @csrf @method('DELETE')
              <button class="px-3 py-1.5 rounded bg-rose-600/80 hover:bg-rose-600">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
