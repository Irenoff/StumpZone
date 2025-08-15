{{-- resources/views/deliver_panel/dashboard.blade.php --}}
@extends('deliver_panel.layouts.app')
@section('title','Deliver • Deliveries')

@section('content')
<div class="mx-auto space-y-6">

  <style>
    /* Modern, clean styling */
    .list-card {
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px;
      background: rgba(9,14,25,0.7);
      box-shadow: 0 4px 24px rgba(0,0,0,0.15);
      backdrop-filter: blur(12px);
    }
    
    .thead {
      background: linear-gradient(90deg, rgba(30,41,59,0.8) 0%, rgba(15,23,42,0.8) 100%);
    }
    
    .chip {
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(255,255,255,0.05);
      transition: all 0.2s ease;
    }
    
    .chip:hover {
      background: rgba(255,255,255,0.1);
      transform: translateY(-1px);
    }
    
    .chip.active {
      background: rgba(59,130,246,0.2);
      border-color: rgba(59,130,246,0.3);
      color: white;
    }
    
    .status-badge {
      font-size: 0.75rem;
      font-weight: 500;
      padding: 0.35rem 0.75rem;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
    }
    
    .status-badge::before {
      content: '';
      display: block;
      width: 6px;
      height: 6px;
      border-radius: 9999px;
    }
    
    .badge-pending {
      background: rgba(245,158,11,0.1);
      color: rgb(253,230,138);
    }
    .badge-pending::before { background: rgb(253,230,138); }
    
    .badge-delivered {
      background: rgba(16,185,129,0.1);
      color: rgb(110,231,183);
    }
    .badge-delivered::before { background: rgb(110,231,183); }
    
    .badge-cancelled {
      background: rgba(239,68,68,0.1);
      color: rgb(252,165,165);
    }
    .badge-cancelled::before { background: rgb(252,165,165); }
    
    .action-btn {
      padding: 0.5rem 1rem;
      border-radius: 8px;
      font-size: 0.8rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    .deliver-btn { background: rgba(16,185,129,0.2); color: rgb(110,231,183); }
    .deliver-btn:hover { background: rgba(16,185,129,0.3); }
    .cancel-btn { background: rgba(239,68,68,0.2); color: rgb(252,165,165); }
    .cancel-btn:hover { background: rgba(239,68,68,0.3); }
    .table-row:hover { background: rgba(255,255,255,0.03) !important; }
    
    .clip-text { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .address-cell { max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    
    .pagination .page-item.active .page-link {
      background: rgba(59,130,246,0.2);
      border-color: rgba(59,130,246,0.3);
      color: white;
    }
    .pagination .page-link {
      background: transparent;
      border: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.7);
      margin: 0 0.2rem;
      border-radius: 6px;
      min-width: 2rem;
      text-align: center;
    }

    /* Mobile specific styles */
    @media (max-width: 768px) {
      .mobile-hidden { display: none; }
      .mobile-stack { display: flex; flex-direction: column; gap: 0.5rem; }
      .mobile-card {
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        background: rgba(9,14,25,0.7);
      }
      .mobile-card-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
      .mobile-label { font-size: 0.75rem; color: rgba(255,255,255,0.6); }
      .mobile-value { font-weight: 500; color: white; }
      .mobile-status { display: inline-flex; margin-top: 0.5rem; }
      .mobile-actions { display: flex; gap: 0.5rem; margin-top: 0.75rem; }
      .action-btn { padding: 0.5rem; font-size: 0.7rem; flex: 1; text-align: center; }
    }
  </style>

  {{-- Header + flash --}}
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
      <div class="p-1.5 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-700 shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor">
          <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
          <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1v-2a1 1 0 00-.293-.707l-3-3A1 1 0 0016 7h-1V5a1 1 0 00-1-1H3z" />
        </svg>
      </div>
      <h1 class="text-2xl font-bold text-white md:text-3xl">Delivery Dashboard</h1>
    </div>
    
    @if(session('success'))
      <div class="flex items-center gap-2 px-4 py-2 text-sm border rounded-lg bg-emerald-900/50 border-emerald-700/50 text-emerald-100 mobile-hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
      </div>
    @endif
    
    @if(session('error'))
      <div class="flex items-center gap-2 px-4 py-2 text-sm border rounded-lg bg-rose-900/50 border-rose-700/50 text-rose-100 mobile-hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        {{ session('error') }}
      </div>
    @endif
  </div>

  {{-- Mobile flash (same look, visible only on mobile) --}}
  @if(session('success'))
    <div class="flex items-center gap-2 px-4 py-2 text-sm border rounded-lg bg-emerald-900/50 border-emerald-700/50 text-emerald-100 md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
      {{ session('success') }}
    </div>
  @endif
  
  @if(session('error'))
    <div class="flex items-center gap-2 px-4 py-2 text-sm border rounded-lg bg-rose-900/50 border-rose-700/50 text-rose-100 md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
      </svg>
      {{ session('error') }}
    </div>
  @endif

  {{-- Filters --}}
  <div class="flex flex-wrap items-center gap-2 mb-6">
    @php
      $q = request()->except('page');
      $is = fn($v) => request('status')===$v ? 'active' : '';
    @endphp
    <a href="{{ url()->current() }}" class="px-4 py-2 rounded-lg chip {{ $is(null) }} text-sm font-medium">All Deliveries</a>
    <a href="{{ url()->current() . '?' . http_build_query($q + ['status'=>'pending']) }}"   class="px-4 py-2 rounded-lg chip {{ $is('pending') }} text-sm font-medium">Pending</a>
    <a href="{{ url()->current() . '?' . http_build_query($q + ['status'=>'delivered']) }}" class="px-4 py-2 rounded-lg chip {{ $is('delivered') }} text-sm font-medium">Delivered</a>
    <a href="{{ url()->current() . '?' . http_build_query($q + ['status'=>'cancelled']) }}" class="px-4 py-2 rounded-lg chip {{ $is('cancelled') }} text-sm font-medium">Cancelled</a>
  </div>

  {{-- Stats Cards --}}
  <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
    <div class="p-4 border rounded-xl bg-gradient-to-br from-blue-900/40 to-blue-800/30 border-blue-800/30">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-blue-200">Total Deliveries</p>
          <p class="mt-1 text-2xl font-semibold text-white">{{ $deliveries->total() }}</p>
        </div>
        <div class="p-3 rounded-lg bg-blue-900/20">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
      </div>
    </div>
    
    <div class="p-4 border rounded-xl bg-gradient-to-br from-amber-900/40 to-amber-800/30 border-amber-800/30">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-amber-200">Pending</p>
          <p class="mt-1 text-2xl font-semibold text-white">{{ $deliveries->where('status', 'pending')->count() }}</p>
        </div>
        <div class="p-3 rounded-lg bg-amber-900/20">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>
    
    <div class="p-4 border rounded-xl bg-gradient-to-br from-emerald-900/40 to-emerald-800/30 border-emerald-800/30">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-emerald-200">Completed</p>
          <p class="mt-1 text-2xl font-semibold text-white">{{ $deliveries->where('status', 'delivered')->count() }}</p>
        </div>
        <div class="p-3 rounded-lg bg-emerald-900/20">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>
    </div>
  </div>

  {{-- Desktop Table --}}
  <div class="overflow-hidden list-card mobile-hidden">
    <div class="px-6 py-4 text-sm font-semibold text-white border-b border-white/10">Delivery Records</div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm divide-y divide-white/5">
        <thead class="text-left text-slate-200 thead">
          <tr>
            <th class="px-6 py-3 font-medium">Delivery #</th>
            <th class="px-6 py-3 font-medium">Order</th>
            <th class="px-6 py-3 font-medium">Customer</th>
            <th class="px-6 py-3 font-medium">Contact</th>
            <th class="px-6 py-3 font-medium">Address</th>
            <th class="px-6 py-3 font-medium">Method</th> {{-- NEW --}}
            <th class="px-6 py-3 font-medium text-right">Total</th>
            <th class="px-6 py-3 font-medium text-center">Status</th>
            <th class="px-6 py-3 font-medium text-center">Actions</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-white/5 text-slate-200">
          @php
            $sportTable = [
              'cricket'    => 'cricket_equipment',
              'football'   => 'football_equipment',
              'basketball' => 'basketball_equipment',
              'badminton'  => 'badminton_equipment',
              'boxing'     => 'boxing_equipment',
            ];
          @endphp

          @forelse($deliveries as $d)
            @php
              // ---- SAFE FALLBACKS (no controller changes) ----
              $order = \Illuminate\Support\Facades\DB::table('orders')->where('id', $d->order_id)->first();

              // Also try users table via order->user_id
              $user  = ($order && isset($order->user_id))
                       ? \Illuminate\Support\Facades\DB::table('users')->where('id', $order->user_id)->first()
                       : null;

              // Customer fields: deliveries.* → orders.* → users.*
              $custName    = $d->customer_name
                             ?? ($order->customer_name ?? ($order->user_name ?? ($user->name ?? '—')));
              $custEmail   = $d->customer_email
                             ?? ($order->customer_email ?? ($user->email ?? '—'));
              $custPhone   = $d->customer_phone
                             ?? ($order->customer_phone ?? ($user->phone ?? '—'));
              $custAddress = $d->customer_address
                             ?? ($order->customer_address ?? '—');

              // Delivery method fallback
              $deliveryMethod = $d->delivery_method ?? ($order->delivery_method ?? '—');

              // Total
              $rowTotal = (float)($d->total ?? 0);
              if ($rowTotal <= 0) {
                  if ($order && isset($order->grand_total)) {
                      $rowTotal = (float)$order->grand_total;
                  }
              }
            @endphp

            <tr class="table-row">
              <td class="px-6 py-4 font-medium text-white">#{{ $d->id }}</td>
              <td class="px-6 py-4">#{{ $d->order_number ?? $d->order_id }}</td>

              {{-- Customer --}}
              <td class="px-6 py-4">
                <div class="font-medium text-white">{{ $custName }}</div>
              </td>
              
              {{-- Contact --}}
              <td class="px-6 py-4">
                <div class="clip-text" title="{{ $custEmail }}">{{ $custEmail }}</div>
                @if($custPhone && $custPhone !== '—')
                  <div class="text-xs text-slate-400">{{ $custPhone }}</div>
                @endif
              </td>

              {{-- Address --}}
              <td class="px-6 py-4 address-cell" title="{{ $custAddress }}">{{ $custAddress }}</td>

              {{-- Method (NEW) --}}
              <td class="px-6 py-4">{{ ucfirst($deliveryMethod) }}</td>

              {{-- Total (LKR) --}}
              <td class="px-6 py-4 font-medium text-right text-white"> {{ number_format($rowTotal, 2) }}</td>

              {{-- Status --}}
              <td class="px-6 py-4 text-center">
                @if($d->status === 'pending')
                  <span class="status-badge badge-pending">Pending</span>
                @elseif($d->status === 'delivered')
                  <span class="status-badge badge-delivered">Delivered</span>
                @elseif($d->status === 'cancelled')
                  <span class="status-badge badge-cancelled">Cancelled</span>
                @else
                  <span class="status-badge">{{ ucfirst($d->status ?? 'pending') }}</span>
                @endif
              </td>

              {{-- Actions --}}
              <td class="px-6 py-4 text-center">
                <div class="flex items-center justify-center gap-2">
                  <form method="POST" action="{{ route('deliver.deliveries.delivered', $d->id) }}">
                    @csrf
                    <button @disabled(($d->status ?? 'pending')!=='pending')
                      class="action-btn deliver-btn" @disabled(($d->status ?? 'pending')!=='pending')>
                      Deliver
                    </button>
                  </form>
                  <form method="POST" action="{{ route('deliver.deliveries.cancelled', $d->id) }}">
                    @csrf
                    <button @disabled(($d->status ?? 'pending')!=='pending')
                      class="action-btn cancel-btn" @disabled(($d->status ?? 'pending')!=='pending')>
                      Cancel
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="px-6 py-8 text-center text-slate-400">
                <div class="flex flex-col items-center justify-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                  </svg>
                  <p class="text-sm">No deliveries found</p>
                  @if(request('status') || request('search'))
                    <a href="{{ url()->current() }}" class="mt-2 text-xs text-blue-400 hover:text-blue-300">Clear filters</a>
                  @endif
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if($deliveries->hasPages())
      <div class="px-6 py-4 border-t border-white/10">
        {{ $deliveries->withQueryString()->links() }}
      </div>
    @endif
  </div>

  {{-- Mobile Delivery List --}}
  <div class="space-y-3 md:hidden">
    <h2 class="text-lg font-semibold text-white">Delivery Records</h2>
    
    @forelse($deliveries as $d)
      @php
        $order = \Illuminate\Support\Facades\DB::table('orders')->where('id', $d->order_id)->first();
        $user  = ($order && isset($order->user_id))
                 ? \Illuminate\Support\Facades\DB::table('users')->where('id', $order->user_id)->first()
                 : null;

        $custName    = $d->customer_name
                       ?? ($order->customer_name ?? ($order->user_name ?? ($user->name ?? '—')));
        $custEmail   = $d->customer_email
                       ?? ($order->customer_email ?? ($user->email ?? '—'));
        $custPhone   = $d->customer_phone
                       ?? ($order->customer_phone ?? ($user->phone ?? '—'));
        $custAddress = $d->customer_address
                       ?? ($order->customer_address ?? '—');

        $deliveryMethod = $d->delivery_method ?? ($order->delivery_method ?? '—');

        $rowTotal = (float)($d->total ?? 0);
        if ($rowTotal <= 0) {
            if ($order && isset($order->grand_total)) {
                $rowTotal = (float)$order->grand_total;
            }
        }
      @endphp

      <div class="mobile-card">
        <div class="mobile-card-grid">
          <div>
            <div class="mobile-label">Delivery #</div>
            <div class="mobile-value">#{{ $d->id }}</div>
          </div>
          <div>
            <div class="mobile-label">Order #</div>
            <div class="mobile-value">#{{ $d->order_number ?? $d->order_id }}</div>
          </div>
        </div>
        
        <div class="mt-3">
          <div class="mobile-label">Customer</div>
          <div class="mobile-value">{{ $custName }}</div>
        </div>
        
        <div class="mt-3 mobile-card-grid">
          <div>
            <div class="mobile-label">Contact</div>
            <div class="mobile-value">{{ $custEmail }}</div>
            @if($custPhone && $custPhone !== '—')
              <div class="text-sm mobile-value">{{ $custPhone }}</div>
            @endif
          </div>
          <div>
            <div class="mobile-label">Total</div>
            <div class="mobile-value">LKR{{ number_format($rowTotal, 2) }}</div>
          </div>
        </div>

        {{-- NEW: Delivery Method --}}
        <div class="mt-3 mobile-card-grid">
          <div>
            <div class="mobile-label">Method</div>
            <div class="mobile-value">{{ ucfirst($deliveryMethod) }}</div>
          </div>
          <div></div>
        </div>
        
        <div class="mt-3">
          <div class="mobile-label">Address</div>
          <div class="text-sm mobile-value">{{ $custAddress }}</div>
        </div>
        
        <div class="mt-3">
          @if($d->status === 'pending')
            <span class="status-badge badge-pending mobile-status">Pending</span>
          @elseif($d->status === 'delivered')
            <span class="status-badge badge-delivered mobile-status">Delivered</span>
          @elseif($d->status === 'cancelled')
            <span class="status-badge badge-cancelled mobile-status">Cancelled</span>
          @else
            <span class="status-badge mobile-status">{{ ucfirst($d->status ?? 'pending') }}</span>
          @endif
        </div>
        
        @if(($d->status ?? 'pending') === 'pending')
          <div class="mobile-actions">
            <form method="POST" action="{{ route('deliver.deliveries.delivered', $d->id) }}" class="flex-1">
              @csrf
              <button class="w-full action-btn deliver-btn">Deliver</button>
            </form>
            <form method="POST" action="{{ route('deliver.deliveries.cancelled', $d->id) }}" class="flex-1">
              @csrf
              <button class="w-full action-btn cancel-btn">Cancel</button>
            </form>
          </div>
        @endif
      </div>
    @empty
      <div class="p-6 text-center text-slate-400">
        <div class="flex flex-col items-center justify-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
          </svg>
          <p class="text-sm">No deliveries found</p>
          @if(request('status') || request('search'))
            <a href="{{ url()->current() }}" class="mt-2 text-xs text-blue-400 hover:text-blue-300">Clear filters</a>
          @endif
        </div>
      </div>
    @endforelse
    
    {{-- Mobile Pagination --}}
    @if($deliveries->hasPages())
      <div class="mt-4">
        {{ $deliveries->withQueryString()->links() }}
      </div>
    @endif
  </div>
</div>
@endsection
