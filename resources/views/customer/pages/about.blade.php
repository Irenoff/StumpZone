@extends('layouts.app')

@section('title', 'About – StumpZone')

@section('content')
<div class="min-h-screen overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-slate-100">

  <!-- Animated background elements -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-amber-500/10 blur-[100px] animate-float1"></div>
    <div class="absolute bottom-1/3 right-1/4 w-72 h-72 rounded-full bg-orange-500/10 blur-[120px] animate-float2"></div>
  </div>

  <!-- Hero Section -->
  <div class="relative px-6 pt-32 pb-24 mx-auto text-center max-w-7xl">
    <div class="inline-flex mb-6">
      <span class="text-xs font-semibold tracking-wider text-amber-400 bg-amber-400/10 px-3 py-1.5 rounded-full">
        OUR JOURNEY
      </span>
    </div>
    <h1 class="mb-6 text-5xl font-bold tracking-tight md:text-7xl">
      <span class="text-transparent bg-gradient-to-r from-amber-400 via-orange-400 to-amber-500 bg-clip-text animate-gradient">
        Redefining Sports
      </span>
    </h1>
    <p class="max-w-3xl mx-auto text-xl leading-relaxed text-slate-300">
      Where passion meets innovation in the world of cricket. We're not just selling gear - we're crafting experiences that elevate your game.
    </p>
  </div>

  <!-- Main Content -->
  <div class="relative max-w-6xl px-6 pb-32 mx-auto space-y-32">

    <!-- Founding Story -->
    <section class="grid items-center gap-16 md:grid-cols-2">
      <div class="relative">
        <div class="absolute transition-opacity duration-500 opacity-0 -inset-4 bg-gradient-to-r from-amber-500/10 to-orange-500/10 rounded-2xl blur-lg group-hover:opacity-100"></div>
        <div class="relative h-full overflow-hidden border rounded-2xl border-slate-700 bg-slate-800/50 backdrop-blur-sm">
          <div class="aspect-[5/4] bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
            <div class="text-8xl animate-bounce">🏏</div>
          </div>
        </div>
      </div>
      <div class="space-y-6">
        <h2 class="text-3xl font-bold md:text-4xl text-amber-400">Born on the Pitch</h2>
        <p class="text-lg leading-relaxed text-slate-300">
          StumpZone was conceived in 2015 during a heated local cricket match when our founder, a passionate player, couldn't find quality gear that matched his professional aspirations. That frustration sparked a revolution.
        </p>
        <p class="text-lg leading-relaxed text-slate-300">
          What began as a small workshop repairing bats has grown into Sri Lanka's premier cricket equipment innovator, trusted by amateur and professional players alike.
        </p>
        <div class="pt-4">
          <div class="flex items-center gap-4">
            <div class="text-4xl">🏆</div>
            <div>
              <p class="text-2xl font-bold text-white">15,000+</p>
              <p class="text-sm text-slate-400">Players equipped</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section>
      <div class="mb-16 text-center">
        <h2 class="mb-4 text-3xl font-bold md:text-4xl">
          <span class="text-transparent bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text">
            Our Cricket Creed
          </span>
        </h2>
        <p class="max-w-2xl mx-auto text-lg text-slate-300">
          The principles that guide every stitch, every swing, and every innovation
        </p>
      </div>
      <div class="grid gap-8 md:grid-cols-3">
        <div class="relative p-8 overflow-hidden transition-all duration-300 border group rounded-2xl border-slate-700 bg-slate-800/50 backdrop-blur-sm hover:border-amber-400">
          <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-amber-500/10 to-orange-500/10 group-hover:opacity-100 rounded-xl"></div>
          <div class="relative z-10">
            <div class="flex items-center justify-center mb-6 text-2xl rounded-lg w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500">
              ✨
            </div>
            <h3 class="mb-3 text-xl font-bold">Authentic Craftsmanship</h3>
            <p class="text-slate-300">
              Each product is handcrafted using traditional techniques perfected over generations, combined with modern technology.
            </p>
          </div>
        </div>
        <div class="relative p-8 overflow-hidden transition-all duration-300 border group rounded-2xl border-slate-700 bg-slate-800/50 backdrop-blur-sm hover:border-amber-400">
          <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-amber-500/10 to-orange-500/10 group-hover:opacity-100 rounded-xl"></div>
          <div class="relative z-10">
            <div class="flex items-center justify-center mb-6 text-2xl rounded-lg w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500">
              ♻️
            </div>
            <h3 class="mb-3 text-xl font-bold">Sustainable Play</h3>
            <p class="text-slate-300">
              We source materials responsibly and implement eco-friendly practices without compromising performance.
            </p>
          </div>
        </div>
        <div class="relative p-8 overflow-hidden transition-all duration-300 border group rounded-2xl border-slate-700 bg-slate-800/50 backdrop-blur-sm hover:border-amber-400">
          <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-amber-500/10 to-orange-500/10 group-hover:opacity-100 rounded-xl"></div>
          <div class="relative z-10">
            <div class="flex items-center justify-center mb-6 text-2xl rounded-lg w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500">
              🌍
            </div>
            <h3 class="mb-3 text-xl font-bold">Community First</h3>
            <p class="text-slate-300">
              We reinvest in local cricket programs and nurture emerging talent through sponsorships and coaching.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section>
      <div class="mb-16 text-center">
        <h2 class="mb-4 text-3xl font-bold md:text-4xl">
          <span class="text-transparent bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text">
            The StumpZone Squad
          </span>
        </h2>
        <p class="max-w-2xl mx-auto text-lg text-slate-300">
          A team of former players, master craftsmen, and cricket fanatics
        </p>
      </div>
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="text-center group">
          <div class="relative w-40 h-40 mx-auto mb-4 overflow-hidden transition-all duration-300 border-2 border-transparent rounded-full group-hover:border-amber-400">
            <div class="absolute inset-0 flex items-center justify-center text-5xl bg-gradient-to-br from-slate-800 to-slate-900">
              👨‍💼
            </div>
            <div class="absolute inset-0 flex items-end justify-center pb-4 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 via-transparent to-transparent group-hover:opacity-100">
              <span class="px-2 py-1 text-xs rounded-full bg-amber-500">Founder</span>
            </div>
          </div>
          <h3 class="text-xl font-semibold">Hiranya Denuwan</h3>
          <p class="text-amber-400">CEO & Master Batmaker</p>
          <p class="mt-2 text-sm text-slate-400">Professinal at natinal level</p>
        </div>
        <div class="text-center group">
          <div class="relative w-40 h-40 mx-auto mb-4 overflow-hidden transition-all duration-300 border-2 border-transparent rounded-full group-hover:border-amber-400">
            <div class="absolute inset-0 flex items-center justify-center text-5xl bg-gradient-to-br from-slate-800 to-slate-900">
              👩‍🔬
            </div>
            <div class="absolute inset-0 flex items-end justify-center pb-4 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 via-transparent to-transparent group-hover:opacity-100">
              <span class="px-2 py-1 text-xs rounded-full bg-amber-500">Materials Expert</span>
            </div>
          </div>
          <h3 class="text-xl font-semibold">Kashav Maharaj</h3>
          <p class="text-amber-400">Head of R&D</p>
          <p class="mt-2 text-sm text-slate-400">Cricket biomechanics specialist</p>
        </div>
        <div class="text-center group">
          <div class="relative w-40 h-40 mx-auto mb-4 overflow-hidden transition-all duration-300 border-2 border-transparent rounded-full group-hover:border-amber-400">
            <div class="absolute inset-0 flex items-center justify-center text-5xl bg-gradient-to-br from-slate-800 to-slate-900">
              👨‍🎨
            </div>
            <div class="absolute inset-0 flex items-end justify-center pb-4 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 via-transparent to-transparent group-hover:opacity-100">
              <span class="px-2 py-1 text-xs rounded-full bg-amber-500">Steve Smith</span>
            </div>
          </div>
          <h3 class="text-xl font-semibold">David Miller</h3>
          <p class="text-amber-400">Creative Director</p>
          <p class="mt-2 text-sm text-slate-400">Branding visionary</p>
        </div>
        <div class="text-center group">
          <div class="relative w-40 h-40 mx-auto mb-4 overflow-hidden transition-all duration-300 border-2 border-transparent rounded-full group-hover:border-amber-400">
            <div class="absolute inset-0 flex items-center justify-center text-5xl bg-gradient-to-br from-slate-800 to-slate-900">
              👩‍🏫
            </div>
            <div class="absolute inset-0 flex items-end justify-center pb-4 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/70 via-transparent to-transparent group-hover:opacity-100">
              <span class="px-2 py-1 text-xs rounded-full bg-amber-500">Player Coach</span>
            </div>
          </div>
          <h3 class="text-xl font-semibold">Eion Morgan</h3>
          <p class="text-amber-400">Community Manager</p>
          <p class="mt-2 text-sm text-slate-400">Former national team coach</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="relative overflow-hidden rounded-2xl">
      <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-500 opacity-90"></div>
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center"></div>
      <div class="relative z-10 p-12 text-center">
        <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl drop-shadow-lg">
          Ready to Elevate Your Game?
        </h2>
        <p class="max-w-2xl mx-auto mb-8 text-lg text-white/90 drop-shadow-md">
          Join thousands of players who trust StumpZone for premium cricket equipment and expert advice.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="#" class="px-8 py-3.5 font-semibold rounded-full bg-slate-900 hover:bg-slate-800 text-white transition-all shadow-lg hover:shadow-amber-500/30">
            Explore Our Gear
          </a>
          <a href="#" class="px-8 py-3.5 font-semibold rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm border border-white/20 transition-all">
            Book Custom Fitting
          </a>
        </div>
      </div>
    </section>
  </div>
</div>

<style>
  .animate-gradient {
    background-size: 300% 300%;
    animation: gradient 6s ease infinite;
  }
  @keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  .animate-float1 {
    animation: float 8s ease-in-out infinite;
  }
  .animate-float2 {
    animation: float 10s ease-in-out infinite reverse;
  }
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
  }
  .animate-bounce {
    animation: bounce 2s infinite;
  }
  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
  }
</style>
@endsection