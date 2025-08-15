{{-- resources/views/deliver_panel/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Deliver • Panel')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    /* ===== NIMBUS design ===== */
    :root{
      --ink:#0b0f1a;
      --slate:#0f172a;
      --muted:#93a4c1;
      --ring:rgba(148,163,184,.25);
      --pill:rgba(255,255,255,.06);
      --glass:rgba(13,18,31,.62);
      --glow:#22d3ee;
      --glow2:#10b981;
    }

    /* Background: conic glow + grain */
    .nimbus {
      min-height: 100vh;
      color: #e5e7eb;
      background:
        radial-gradient(900px 600px at 15% -10%, rgba(34,211,238,.12), transparent 60%),
        radial-gradient(800px 600px at 110% 120%, rgba(16,185,129,.10), transparent 60%),
        conic-gradient(from 180deg at 50% -10%, #0b1220, #0b0f1a 35%, #0a0e19 70%, #0b1220);
      position: relative;
      overflow-x: hidden;
    }
    .nimbus:after{
      content:"";
      position:fixed; inset:0; pointer-events:none;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 160 160'%3E%3Cfilter id='n'%3E%3CfeTurbulence baseFrequency='0.75' numOctaves='2' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3CfeComponentTransfer%3E%3CfeFuncA type='table' tableValues='0 0 0 0.03 0.06'/%3E%3C/feComponentTransfer%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      opacity:.45;
      mix-blend-mode:soft-light;
    }

    /* Container */
    .wrap{max-width:80rem;margin-inline:auto;padding-inline:1rem}
    @media (min-width:640px){.wrap{padding-inline:1.5rem}}
    @media (min-width:1024px){.wrap{padding-inline:2rem}}

    /* Header */
    .glass {
      backdrop-filter: blur(14px) saturate(135%);
      -webkit-backdrop-filter: blur(14px) saturate(135%);
      background: var(--glass);
      border-bottom: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 12px 30px rgba(0,0,0,.25);
    }
    .brand {
      display:grid; place-content:center; width:2.25rem; height:2.25rem;
      border-radius:.9rem; color:#fff; font-weight:800; font-size:.95rem;
      background-image: linear-gradient(135deg, var(--glow), var(--glow2));
      box-shadow: 0 8px 22px rgba(34,211,238,.35), inset 0 0 10px rgba(255,255,255,.25);
      transform: rotate(10deg);
    }

    /* Pill nav */
    .pill {
      display:inline-flex; gap:.25rem; padding:.25rem .3rem; border-radius:999px;
      background: var(--pill); border:1px solid rgba(255,255,255,.08);
    }
    .pill a{
      display:inline-flex; align-items:center; gap:.45rem; padding:.55rem .9rem;
      border-radius:999px; font-size:.875rem; color:#cdd5e6; transition:all .2s ease;
    }
    .pill a:hover{ color:#fff; background:rgba(255,255,255,.06) }
    .pill a.active{
      color:#fff;
      background:linear-gradient(135deg, rgba(16,185,129,.28), rgba(34,211,238,.24));
      box-shadow: 0 0 0 1px var(--ring) inset, 0 8px 18px rgba(16,185,129,.22);
    }

    /* Buttons */
    .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1rem;border-radius:.9rem;font-weight:700;font-size:.875rem;color:#fff;transition:transform .15s ease,opacity .2s ease,box-shadow .2s ease}
    .btn-primary{background-image:linear-gradient(90deg, rgba(34,211,238,.92), rgba(59,130,246,.92)); box-shadow:0 10px 24px rgba(59,130,246,.25)}
    .btn-primary:hover{transform:translateY(-1px);opacity:.96}

    .link{color:#cbd5e1}
    .link:hover{color:#fff}

    /* Mobile */
    .only-md{display:none}
    @media (max-width:768px){ .hide-md{display:none} .only-md{display:block} }

    /* Card ring utility */
    .ringed{border:1px solid rgba(255,255,255,.08); border-radius:1rem; background:rgba(15,20,33,.6)}
  </style>

  @stack('head')
</head>
<body class="nimbus">

  <!-- Header -->
  <header class="sticky top-0 z-50 glass">
    <div class="flex items-center justify-between h-16 wrap">
      <div class="flex items-center gap-3">
        <a href="{{ route('deliver.delivery.dashboard') }}" class="flex items-center gap-2">
          <span class="brand">D</span>
          <span class="text-xl font-extrabold tracking-tight text-transparent bg-clip-text"
                style="background-image:linear-gradient(90deg,var(--glow),var(--glow2))">
            Deliver
          </span>
        </a>

        <!-- Desktop nav -->
        <nav class="ml-4 hide-md">
          <div class="pill">
            <a href="{{ route('deliver.delivery.dashboard') }}"
               class="{{ request()->routeIs('deliver.delivery.dashboard') ? 'active' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-80" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
              </svg>
              Dashboard
            </a>

            @yield('topnav') {{-- optional more pills from child views --}}
          </div>
        </nav>
      </div>

      <div class="flex items-center gap-2">
        <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-lg hide-md link hover:bg-white/5">Profile</a>
        <form method="POST" action="{{ route('logout') }}" class="hide-md">
          @csrf
          <button class="btn btn-primary">Logout</button>
        </form>

        <!-- Mobile toggle -->
        <button id="menuBtn" class="px-3 py-2 rounded-lg only-md link hover:bg-white/5" aria-expanded="false" aria-controls="mnav">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4 6h16v2H4zM4 11h16v2H4zM4 16h16v2H4z"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile sheet -->
    <div id="mnav" class="only-md hidden border-t border-[rgba(255,255,255,.08)]">
      <div class="py-3 space-y-2 wrap">
        <a href="{{ route('deliver.delivery.dashboard') }}"
           class="block px-4 py-2 rounded-lg link hover:bg-white/5 {{ request()->routeIs('deliver.delivery.dashboard') ? 'font-semibold text-white' : '' }}">
           Dashboard
        </a>
        @yield('mobilenav')
        <div class="pt-2 border-t border-[rgba(255,255,255,.08)]">
          <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg link hover:bg-white/5">Profile</a>
          <form method="POST" action="{{ route('logout') }}" class="mt-2">@csrf
            <button class="w-full btn btn-primary">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="py-8 wrap">
    {{-- Optional page header slot --}}
    @hasSection('page-header')
      <div class="p-4 mb-6 ringed">
        @yield('page-header')
      </div>
    @endif

    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="py-10 text-sm wrap" style="color:var(--muted)">
    <div class="flex items-center justify-between">
      <div>© {{ date('Y') }} <span class="font-semibold" style="color:var(--glow)">StumpZone</span> · Delivery Panel</div>
      <div class="flex items-center gap-4">
        <a href="#" class="link">Terms</a>
        <a href="#" class="link">Privacy</a>
        <a href="#" class="link">Support</a>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    (function(){
      const btn = document.getElementById('menuBtn');
      const sheet = document.getElementById('mnav');
      if(!btn||!sheet) return;
      btn.addEventListener('click', ()=>{
        sheet.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', sheet.classList.contains('hidden') ? 'false' : 'true');
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>
