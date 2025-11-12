<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Synkro Chat') }} - Plataforma de Comunicação Interna</title>
    <link rel="icon" type="image/png" href="{{ asset('logo-synkro.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style> body { font-family: 'Inter', sans-serif; } </style>
  </head>

  <body class="bg-slate-50">
    <!-- Background decorativo -->
    <div aria-hidden="true" class="fixed inset-0 -z-10 overflow-hidden">
      <div class="pointer-events-none absolute -top-24 right-[-10%] h-[28rem] w-[28rem] rounded-full bg-gradient-to-br from-indigo-400/30 to-fuchsia-400/20 blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-24 left-[-10%] h-[28rem] w-[28rem] rounded-full bg-gradient-to-br from-blue-400/30 to-cyan-400/20 blur-3xl"></div>

      <!-- Grid sutil -->
      <svg class="absolute inset-0 h-full w-full text-slate-700/40 opacity-[0.08]" aria-hidden="true">
        <defs>
          <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
            <path d="M32 0H0V32" fill="none" stroke="currentColor" stroke-width="1"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#grid)" />
      </svg>
    </div>

    <div class="min-h-screen flex flex-col">

      <!-- Navbar -->
      <header class="sticky top-0 z-40 border-b border-slate-200/60 bg-white/70 backdrop-blur-md">
        <nav class="container-pad py-4">
          <div class="flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
              <span class="p-2 bg-white rounded-xl shadow-sm ring-1 ring-slate-200">
                <img src="{{ asset('logo-synkro.png') }}" alt="Logo Synkro" class="w-8 h-8 object-contain">
              </span>
              <span class="text-xl font-bold gradient-text">{{ config('app.name', 'Synkro Chat') }}</span>
            </a>

            <div class="flex items-center gap-3">
              @if (Route::has('login'))
                @auth
                  <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                @else
                  <a href="{{ route('login') }}" class="btn-ghost">Entrar</a>
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">Registrar</a>
                  @endif
                @endauth
              @endif
            </div>
          </div>
        </nav>
      </header>

      <!-- Hero -->
      <main class="flex-1">
        <section class="container-pad py-16 md:py-24 lg:py-28">
          <div class="grid items-center gap-12 md:gap-14 lg:gap-16 md:grid-cols-2">

            <!-- Texto -->
            <div class="space-y-8">
              <span class="badge">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Em tempo real, simples e seguro
              </span>

              <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="gradient-text">Comunicação inteligente</span><br>
                para equipes conectadas
              </h1>

              <p class="text-lg text-slate-600 max-w-xl">
                Canais hierárquicos, mensagens instantâneas e um painel administrativo intuitivo — tudo para reduzir ruído e acelerar decisões.
              </p>

              <div class="flex flex-wrap gap-3">
                @auth
                  <a href="{{ url('/dashboard') }}" class="btn-primary text-lg px-6 py-3">
                    <svg class="w-5 h-5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Acessar Dashboard
                  </a>
                @else
                  <a href="{{ route('register') }}" class="btn-primary text-lg px-6 py-3">
                    <svg class="w-5 h-5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Começar agora
                  </a>
                  <a href="{{ route('login') }}" class="btn-secondary text-lg px-6 py-3">
                    <svg class="w-5 h-5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Entrar
                  </a>
                @endauth
              </div>

              <div class="flex flex-wrap items-center gap-6 pt-2 text-sm text-slate-600">
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                  </svg>
                  Tempo real com WebSocket
                </span>
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                  </svg>
                  Autenticação e níveis de acesso
                </span>
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  Canais por equipes e projetos
                </span>
              </div>
            </div>

            <!-- Preview -->
            <div class="relative">
              <div class="absolute -inset-4 rounded-3xl bg-gradient-to-tr from-indigo-500/20 via-purple-500/10 to-cyan-500/10 blur-xl"></div>

              <div class="relative card p-0 shadow-xl">
                <!-- “Browser frame” -->
                <div class="rounded-t-2xl bg-slate-900 text-white px-4 py-3 flex items-center gap-2">
                  <span class="h-3 w-3 rounded-full bg-red-500"></span>
                  <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
                  <span class="h-3 w-3 rounded-full bg-emerald-500"></span>
                  <span class="mx-auto text-sm text-slate-300">Synkro • Canal Geral</span>
                </div>

                <!-- Chat -->
                <div class="bg-slate-50 p-5 space-y-4 min-h-[320px]">
                  <!-- Message 1 -->
                  <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-full bg-slate-400 text-white grid place-items-center font-semibold">J</div>
                    <div class="max-w-[80%]">
                      <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm ring-1 ring-slate-200">
                        <p class="text-sm font-semibold text-slate-700">João Silva</p>
                        <p class="text-sm text-slate-800">Olá, pessoal! Como está o projeto?</p>
                        <p class="mt-1 text-xs text-slate-500">10:30</p>
                      </div>
                    </div>
                  </div>

                  <!-- Message 2 -->
                  <div class="flex items-start gap-3 justify-end">
                    <div class="max-w-[80%]">
                      <div class="rounded-2xl rounded-tr-md px-4 py-3 shadow-sm text-white bg-gradient-to-br from-blue-600 to-indigo-600">
                        <p class="text-sm font-semibold text-blue-100">Você</p>
                        <p class="text-sm">Tudo certo! Vamos finalizar hoje.</p>
                        <p class="mt-1 text-xs text-blue-100/90">10:32</p>
                      </div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white grid place-items-center font-semibold">V</div>
                  </div>

                  <!-- Message 3 -->
                  <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-full bg-emerald-500 text-white grid place-items-center font-semibold">M</div>
                    <div class="max-w-[80%]">
                      <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm ring-1 ring-slate-200">
                        <p class="text-sm font-semibold text-slate-700">Maria Santos</p>
                        <p class="text-sm text-slate-800">Perfeito! Enviando os arquivos agora.</p>
                        <p class="mt-1 text-xs text-slate-500">10:33</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Input (apenas visual) -->
                <div class="border-t border-slate-200 p-4">
                  <div class="flex items-center gap-3">
                    <input type="text" placeholder="Digite sua mensagem..." class="input-field" disabled>
                    <button class="btn-primary p-3">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- Features -->
        <section class="container-pad pb-16">
          <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="card p-6 transition hover:shadow-md">
              <div class="w-12 h-12 rounded-xl bg-blue-100 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-slate-800 mb-1">Tempo Real</h3>
              <p class="text-sm text-slate-600">Mensagens instantâneas com WebSocket e feedback imediato.</p>
            </div>

            <div class="card p-6 transition hover:shadow-md">
              <div class="w-12 h-12 rounded-xl bg-indigo-100 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-slate-800 mb-1">Canais</h3>
              <p class="text-sm text-slate-600">Estruture conversas por equipes, projetos e hierarquia.</p>
            </div>

            <div class="card p-6 transition hover:shadow-md">
              <div class="w-12 h-12 rounded-xl bg-purple-100 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-slate-800 mb-1">Seguro</h3>
              <p class="text-sm text-slate-600">Autenticação robusta e controle de acesso por papéis.</p>
            </div>
          </div>
        </section>
      </main>

      <!-- Footer -->
      <footer class="bg-white/80 border-t border-slate-200 py-8">
        <div class="container-pad text-center">
          <p class="text-slate-600">
            © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
          </p>
          <p class="text-sm text-slate-500">
            Sistema de chat profissional desenvolvido com Laravel e Livewire.
          </p>
        </div>
      </footer>
    </div>
  </body>
</html>
