@extends('vendor_panel.layouts.app')
@section('title','Vendor • Reviews')

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-white">Customer Reviews</h1>
    <form method="get" class="flex items-center gap-2">
      <label class="text-sm text-gray-300">Per page</label>
      <select name="per_page" class="px-3 py-2 text-white border rounded-lg bg-white/5 border-white/10">
        @foreach([10,15,25,50] as $n)
          <option value="{{ $n }}" {{ request('per_page',15)==$n ? 'selected':'' }}>{{ $n }}</option>
        @endforeach
      </select>
      <button class="px-3 py-2 text-sm bg-blue-600 rounded-lg">Apply</button>
    </form>
  </div>

  <div class="overflow-hidden border rounded-xl bg-white/5 border-white/10">
    <table class="w-full text-sm">
      <thead class="text-left text-white bg-white/10">
        <tr>
          <th class="px-4 py-3">Reviewer</th>
          <th class="px-4 py-3">Rating</th>
          <th class="px-4 py-3">Comment</th>
          <th class="px-4 py-3">Created</th>
        </tr>
      </thead>
      <tbody class="text-gray-200 divide-y divide-white/10">
        @forelse($reviews as $r)
          <tr class="hover:bg-white/5">
            <td class="px-4 py-3 font-medium">
              {{ $r->display_name }}
            </td>
            <td class="px-4 py-3">
              @if(!is_null($r->display_rating) && $r->display_rating !== '')
                <span class="inline-flex items-center px-2 py-1 text-xs text-yellow-300 border rounded bg-yellow-500/20 border-yellow-500/30">
                  ★ {{ $r->display_rating }}
                </span>
              @else
                <span class="text-gray-400">—</span>
              @endif
            </td>
            <td class="px-4 py-3">
              {{ trim((string)$r->display_comment) !== '' ? $r->display_comment : '—' }}
            </td>
            <td class="px-4 py-3">
              {{ !empty($r->created_at) ? \Illuminate\Support\Carbon::parse($r->created_at)->format('Y-m-d H:i') : '—' }}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-10 text-center text-gray-400">No reviews yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    {{ $reviews->appends(request()->query())->links('vendor.pagination.tailwind') }}
  </div>
</div>
@endsection
