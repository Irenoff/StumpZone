@extends('layouts.app')

@section('title', 'Contact – StumpZone')

@section('content')
<div class="relative min-h-screen px-6 py-20 overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-slate-100">

  <!-- Animated gradient orb background -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-0 w-[300px] h-[300px] rounded-full bg-emerald-500/10 blur-[100px] animate-float1"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full bg-teal-500/10 blur-[120px] animate-float2"></div>
  </div>

  <!-- Main container -->
  <div class="relative z-10 max-w-4xl mx-auto">

    <!-- Animated header -->
    <div class="mb-16 text-center">
      <div class="inline-block mb-4">
        <span class="text-xs font-semibold tracking-wider text-emerald-400 bg-emerald-400/10 px-3 py-1.5 rounded-full">
          GET IN TOUCH
        </span>
      </div>
      <h1 class="mb-4 text-4xl font-bold tracking-tight md:text-5xl">
        <span class="text-transparent bg-gradient-to-r from-emerald-300 via-teal-300 to-cyan-300 bg-clip-text animate-gradient">
          Let's Talk Cricket
        </span>
      </h1>
      <p class="max-w-xl mx-auto text-lg text-slate-300">
        Have questions about gear, coaching, or events? Our team is ready to help.
      </p>
    </div>

    <!-- Contact cards (3-column grid) -->
    <div class="grid gap-6 mb-20 sm:grid-cols-3">
      <!-- Email card -->
      <div class="relative p-6 transition-all duration-300 border group rounded-xl bg-slate-800/50 backdrop-blur-sm border-slate-700 hover:border-emerald-400">
        <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 group-hover:opacity-100 rounded-xl"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-center w-12 h-12 mb-4 text-xl rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
            ✉️
          </div>
          <h3 class="mb-2 text-lg font-bold">Email Us</h3>
          <p class="mb-3 text-sm text-slate-300">For general inquiries</p>
          <a href="mailto:hello@stumpzone.com" class="inline-flex items-center gap-1 text-sm font-medium transition-colors text-emerald-400 hover:text-emerald-300">
            hello@stumpzone.com
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- Support card -->
      <div class="relative p-6 transition-all duration-300 border group rounded-xl bg-slate-800/50 backdrop-blur-sm border-slate-700 hover:border-emerald-400">
        <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 group-hover:opacity-100 rounded-xl"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-center w-12 h-12 mb-4 text-xl rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
            🛠️
          </div>
          <h3 class="mb-2 text-lg font-bold">Technical Support</h3>
          <p class="mb-3 text-sm text-slate-300">For gear assistance</p>
          <a href="mailto:support@stumpzone.com" class="inline-flex items-center gap-1 text-sm font-medium transition-colors text-emerald-400 hover:text-emerald-300">
            support@stumpzone.com
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>

      <!-- Phone card -->
      <div class="relative p-6 transition-all duration-300 border group rounded-xl bg-slate-800/50 backdrop-blur-sm border-slate-700 hover:border-emerald-400">
        <div class="absolute transition-opacity duration-500 opacity-0 -inset-1 bg-gradient-to-r from-emerald-500/10 to-teal-500/10 group-hover:opacity-100 rounded-xl"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-center w-12 h-12 mb-4 text-xl rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
            📞
          </div>
          <h3 class="mb-2 text-lg font-bold">Call Us</h3>
          <p class="mb-3 text-sm text-slate-300">Mon-Fri, 9AM-6PM</p>
          <a href="tel:+94112345678" class="inline-flex items-center gap-1 text-sm font-medium transition-colors text-emerald-400 hover:text-emerald-300">
            +94 11 234 5678
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Social proof section -->
    <div class="p-8 mb-16 border bg-slate-800/50 backdrop-blur-sm rounded-xl border-slate-700">
      <div class="max-w-2xl mx-auto text-center">
        <div class="inline-flex mb-6">
          <span class="text-2xl text-amber-400">★</span>
          <span class="text-2xl text-amber-400">★</span>
          <span class="text-2xl text-amber-400">★</span>
          <span class="text-2xl text-amber-400">★</span>
          <span class="text-2xl text-amber-400">★</span>
        </div>
        <blockquote class="mb-6 text-lg italic text-slate-200">
          "StumpZone's customer service is as premium as their gear. Had my bat repaired in 24 hours!"
        </blockquote>
        <div class="flex items-center justify-center gap-3">
          <div class="flex items-center justify-center w-10 h-10 text-lg rounded-full bg-slate-700">
            👨
          </div>
          <div>
            <p class="font-medium text-slate-100">Hiranya Denuwan</p>
            <p class="text-xs text-slate-400">founder of StumpZone</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA section -->
    <div class="text-center">
      <h2 class="mb-6 text-2xl font-bold text-slate-100">Still Have Questions?</h2>
      <p class="max-w-lg mx-auto mb-8 text-slate-300">
        Check our FAQ or connect with us on social media for quick answers.
      </p>
      <div class="flex flex-wrap justify-center gap-3">
        <a href="#" class="flex items-center gap-2 px-6 py-3 font-medium transition-all border rounded-lg bg-slate-800 hover:bg-slate-700 border-slate-700">
          <span>📚</span> FAQ Center
        </a>
        <a href="#" class="flex items-center gap-2 px-6 py-3 font-medium transition-all border rounded-lg bg-slate-800 hover:bg-slate-700 border-slate-700">
          <span>💬</span> Live Chat
        </a>
        <a href="#" class="flex items-center gap-2 px-6 py-3 font-medium transition-all rounded-lg bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600">
          <span>📱</span> WhatsApp
        </a>
      </div>
    </div>

  </div>

  <!-- Floating action button -->
  <div class="fixed z-50 bottom-6 right-6">
    <button onclick="openChat()" class="flex items-center justify-center text-xl transition-transform rounded-full shadow-xl w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 hover:scale-105 group">
      <span class="group-hover:animate-bounce">💬</span>
    </button>
  </div>

  <!-- Chat bubble (hidden by default) -->
  <div id="chatBubble" class="fixed z-50 hidden overflow-hidden border shadow-2xl bottom-24 right-6 w-72 bg-slate-800 rounded-xl border-slate-700">
    <div class="p-4 border-b bg-gradient-to-r from-slate-800 to-slate-700 border-slate-700">
      <div class="flex items-center justify-between">
        <h3 class="font-bold text-slate-100">Quick Help</h3>
        <button onclick="closeChat()" class="text-slate-400 hover:text-slate-200">
          ✕
        </button>
      </div>
    </div>
    <div class="p-4">
      <div class="space-y-3">
        <button onclick="alert('Opening WhatsApp...')" class="flex items-center w-full gap-3 px-4 py-2 text-left transition-colors rounded-lg bg-slate-700 hover:bg-slate-600">
          <span class="text-emerald-400">💬</span>
          <span>Chat on WhatsApp</span>
        </button>
        <button onclick="alert('Calling support...')" class="flex items-center w-full gap-3 px-4 py-2 text-left transition-colors rounded-lg bg-slate-700 hover:bg-slate-600">
          <span class="text-emerald-400">📞</span>
          <span>Request callback</span>
        </button>
        <button onclick="alert('Redirecting to FAQ...')" class="flex items-center w-full gap-3 px-4 py-2 text-left transition-colors rounded-lg bg-slate-700 hover:bg-slate-600">
          <span class="text-emerald-400">❓</span>
          <span>Browse FAQs</span>
        </button>
      </div>
    </div>
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
    50% { transform: translateY(-15px); }
  }
  .animate-bounce {
    animation: bounce 1s infinite;
  }
  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
  }
</style>

<script>
  function openChat() {
    document.getElementById('chatBubble').classList.toggle('hidden');
  }
  function closeChat() {
    document.getElementById('chatBubble').classList.add('hidden');
  }
</script>
@endsection