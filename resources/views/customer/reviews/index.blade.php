@extends('customer.layouts.app')
@section('title', 'Customer Reviews')

@section('page-toolbar')
  <div class="flex items-center justify-between">
    <h1 class="text-lg font-semibold">⭐ Customer Reviews</h1>
    <a href="{{ route('customer.dashboard') }}" class="text-sm rounded-lg px-3 py-1.5 bg-white/5 border border-white/10 hover:bg-white/10">Back to Home</a>
  </div>
@endsection

@section('content')
  <div class="space-y-6">

    {{-- Flash messages --}}
    @if(session('success'))
      <div class="p-3 border rounded-xl border-emerald-500/30 bg-emerald-500/10 text-emerald-100">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="p-3 border rounded-xl border-rose-500/30 bg-rose-500/10 text-rose-100">
        {{ session('error') }}
      </div>
    @endif

    {{-- Review form (only for customers who have at least one order) --}}
    @if($canReview)
      <div class="p-5 border rounded-xl border-white/10 bg-white/5">
        <h2 class="mb-3 text-base font-semibold">Write a review</h2>

        <form action="{{ route('customer.reviews.store') }}" method="POST" class="space-y-4">
          @csrf

          {{-- Rating --}}
          <div>
            <label class="block mb-2 text-sm text-gray-300">Rating</label>
            <div class="flex items-center gap-2">
              @for($i = 1; $i <= 5; $i++)
                <label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer">
                  <input type="radio" name="rating" value="{{ $i }}"
                         @checked(old('rating', optional($myReview)->rating) == $i)>
                  <span>{{ $i }}★</span>
                </label>
              @endfor
            </div>
            @error('rating')
              <p class="mt-1 text-sm text-rose-300">{{ $message }}</p>
            @enderror
          </div>

          {{-- Title --}}
          <div>
            <label class="block mb-2 text-sm text-gray-300">Title (optional)</label>
            <input type="text" name="title"
                   value="{{ old('title', optional($myReview)->title) }}"
                   class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400"
                   maxlength="120" placeholder="e.g., Great experience!" />
            @error('title')
              <p class="mt-1 text-sm text-rose-300">{{ $message }}</p>
            @enderror
          </div>

          {{-- Body --}}
          <div>
            <label class="block mb-2 text-sm text-gray-300">Your review (optional)</label>
            <textarea name="body" rows="4"
                      class="w-full px-3 py-2 text-white bg-gray-900 border border-gray-700 rounded-lg focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400"
                      maxlength="2000"
                      placeholder="Share your thoughts...">{{ old('body', optional($myReview)->body) }}</textarea>
            @error('body')
              <p class="mt-1 text-sm text-rose-300">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-5 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
              {{ $myReview ? 'Update Review' : 'Submit Review' }}
            </button>
            <p class="text-sm text-gray-400">* Only customers with orders can post.</p>
          </div>
        </form>
      </div>
    @else
      @auth
        <div class="p-4 text-gray-300 border rounded-xl border-white/10 bg-white/5">
          You can write a review after placing an order.
        </div>
      @endauth
    @endif

    {{-- Reviews list --}}
    <div class="space-y-4">
      @forelse($reviews as $rev)
        <div class="p-4 border rounded-xl border-white/10 bg-white/5">
          <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
              <div class="rounded-full h-9 w-9 bg-white/10"></div>
              <div>
                <p class="text-sm font-semibold">{{ $rev->user->name ?? 'Customer' }}</p>
                <p class="text-xs text-gray-400">
                  {{ $rev->rating }}★ ·
                  {{ $rev->created_at->timezone('Asia/Kolkata')->format('M d, Y H:i') }}
                </p>
              </div>
            </div>
            @if($rev->title)
              <p class="text-sm font-medium text-gray-200">{{ $rev->title }}</p>
            @endif
          </div>

          @if($rev->body)
            <p class="mt-3 text-sm text-gray-200">{{ $rev->body }}</p>
          @endif
        </div>
      @empty
        <div class="p-6 text-center text-gray-300 border rounded-xl border-white/10 bg-white/5">
          No reviews yet. Be the first to write one!
        </div>
      @endforelse
    </div>

    <div>
      {{ $reviews->links() }}
    </div>
  </div>
@endsection
