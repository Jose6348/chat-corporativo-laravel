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

    <style> 
      body { 
        font-family: 'Inter', sans-serif; 
      }
    </style>
  </head>

  <body class="bg-gray-900 text-white">
    <!-- Background decorativo -->
    <div aria-hidden="true" class="fixed inset-0 -z-10 overflow-hidden">
      <div class="pointer-events-none absolute -top-24 right-[-10%] h-[28rem] w-[28rem] rounded-full bg-gradient-to-br from-purple-500/20 via-cyan-500/20 to-blue-500/20 blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-24 left-[-10%] h-[28rem] w-[28rem] rounded-full bg-gradient-to-br from-blue-500/20 via-indigo-500/20 to-purple-500/20 blur-3xl"></div>
    </div>

    <div class="min-h-screen flex flex-col">
      <!-- Navbar -->
      <header class="sticky top-0 z-40 border-b border-gray-800 bg-gray-900/80 backdrop-blur-md">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <div class="flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
              <div class="p-2 bg-gradient-to-br from-purple-500 to-cyan-500 rounded-xl shadow-lg">
                <img src="{{ asset('logo-synkro.png') }}" alt="Logo Synkro" class="w-8 h-8 object-contain filter brightness-0 invert">
              </div>
              <span class="text-xl font-bold text-white">{{ config('app.name', 'Synkro Chat') }}</span>
            </a>

            <div class="flex items-center gap-4">
              @if (Route::has('login'))
                @auth
                  <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                    Dashboard
                  </a>
                @else
                  <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors font-medium">Entrar</a>
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                      Começar grátis
                    </a>
                  @endif
                @endauth
              @endif
            </div>
          </div>
        </nav>
      </header>

      <!-- Hero Section -->
      <main class="flex-1">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-32">
          <div class="grid items-center gap-12 md:gap-16 lg:grid-cols-2">
            
            <!-- Left: App Preview -->
            <div class="relative order-2 lg:order-1">
              <div class="absolute -inset-4 rounded-3xl bg-gradient-to-tr from-purple-500/30 via-cyan-500/20 to-blue-500/30 blur-2xl"></div>
              
              <!-- Phone Mockup -->
              <div class="relative bg-gray-800 rounded-[3rem] p-4 shadow-2xl border border-gray-700">
                <div class="bg-gray-900 rounded-[2.5rem] overflow-hidden border border-gray-700">
                  <!-- Status Bar -->
                  <div class="bg-gray-800 px-6 py-3 flex items-center justify-between border-b border-gray-700">
                    <span class="text-white text-sm font-medium">20:47</span>
                    <div class="flex items-center gap-1">
                      <div class="w-1 h-1 bg-white rounded-full"></div>
                      <div class="w-1 h-1 bg-white rounded-full"></div>
                      <div class="w-1 h-1 bg-white rounded-full"></div>
                    </div>
                  </div>
                  
                  <!-- App Content -->
                  <div class="bg-gradient-to-b from-gray-900 to-gray-800 p-6 min-h-[500px]">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                      <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-cyan-500 rounded-lg flex items-center justify-center">
                          <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-5 h-5 object-contain filter brightness-0 invert">
                        </div>
                        <span class="text-white font-semibold">Synkro</span>
                      </div>
                      <span class="text-gray-400 text-sm">TODAY</span>
                    </div>
                    
                    <!-- Main Metric -->
                    <div class="text-center mb-8">
                      <div class="text-5xl font-bold text-white mb-2">5h 08m</div>
                      <div class="text-gray-400 text-sm">SCREEN TIME TODAY</div>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-4 mb-6">
                      <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                        <div class="text-gray-400 text-xs mb-2">MOST USED</div>
                        <div class="flex gap-1">
                          <div class="w-6 h-6 bg-blue-500 rounded"></div>
                          <div class="w-6 h-6 bg-pink-500 rounded"></div>
                          <div class="w-6 h-6 bg-red-500 rounded"></div>
                        </div>
                      </div>
                      <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                        <div class="text-gray-400 text-xs mb-2">FOCUS SCORE</div>
                        <div class="text-2xl font-bold text-cyan-400">88%</div>
                      </div>
                      <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                        <div class="text-gray-400 text-xs mb-2">MESSAGES</div>
                        <div class="text-2xl font-bold text-white">131</div>
                      </div>
                    </div>
                    
                    <!-- Chart -->
                    <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700 mb-4">
                      <div class="flex items-end justify-between h-24 gap-1">
                        <div class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-500 rounded-t" style="height: 40%"></div>
                        <div class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-500 rounded-t" style="height: 60%"></div>
                        <div class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-500 rounded-t" style="height: 80%"></div>
                        <div class="flex-1 bg-gradient-to-t from-purple-500 to-cyan-500 rounded-t" style="height: 100%"></div>
                        <div class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-500 rounded-t" style="height: 70%"></div>
                        <div class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-500 rounded-t" style="height: 50%"></div>
                      </div>
                    </div>
                    
                    <!-- Session Info -->
                    <div class="bg-gradient-to-r from-purple-500/20 to-cyan-500/20 rounded-xl p-4 border border-purple-500/30">
                      <div class="text-gray-300 text-sm mb-1">Session - 02:53:22</div>
                      <div class="text-white font-semibold">Work Flow</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right: Marketing Content -->
            <div class="space-y-8 order-1 lg:order-2">
              <!-- Badge -->
              <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-full">
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <span class="text-sm text-gray-300">App Store App of the Day</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-2xl font-bold text-white">4.8</span>
                  <div class="flex gap-0.5">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                  </div>
                  <span class="text-xs text-gray-400 ml-2">100K+ APP RATINGS</span>
                </div>
              </div>

              <!-- Headline -->
              <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight">
                <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                  Comunicação é difícil.
                </span>
              </h1>

              <p class="text-xl text-gray-300 max-w-xl leading-relaxed">
                Então tornamos mais fácil para todos. Junte-se a uma comunidade de mais de 4 milhões na plataforma de chat favorita do mundo.
              </p>

              <!-- CTA Buttons -->
              <div class="flex flex-wrap gap-4 pt-4">
                @auth
                  <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Acessar Dashboard
                  </a>
                @else
                  <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Começar agora
                  </a>
                  <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white font-semibold py-4 px-8 rounded-xl border border-gray-700 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Entrar
                  </a>
                @endauth
              </div>

              <!-- Features -->
              <div class="flex flex-wrap items-center gap-6 pt-4 text-sm text-gray-400">
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                  </svg>
                  Tempo real com WebSocket
                </span>
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                  </svg>
                  Autenticação e níveis de acesso
                </span>
                <span class="inline-flex items-center gap-2">
                  <svg class="w-4.5 h-4.5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  Canais por equipes e projetos
                </span>
              </div>
            </div>

          </div>
        </section>

        <!-- Features Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
          <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 transition hover:border-cyan-500/50 hover:shadow-lg hover:shadow-cyan-500/10">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-white mb-2">Tempo Real</h3>
              <p class="text-sm text-gray-400">Mensagens instantâneas com WebSocket e feedback imediato.</p>
            </div>

            <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 transition hover:border-purple-500/50 hover:shadow-lg hover:shadow-purple-500/10">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-500/30 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-white mb-2">Canais</h3>
              <p class="text-sm text-gray-400">Estruture conversas por equipes, projetos e hierarquia.</p>
            </div>

            <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 transition hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-500/10">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-500/20 border border-blue-500/30 grid place-items-center mb-4">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
              </div>
              <h3 class="font-semibold text-white mb-2">Seguro</h3>
              <p class="text-sm text-gray-400">Autenticação robusta e controle de acesso por papéis.</p>
            </div>
          </div>
        </section>

        <!-- Stats Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 text-center">
          <p class="text-gray-400 text-sm">
            <span class="text-white font-semibold">203, 865, </span>
            <span class="text-cyan-400 font-bold text-lg">35</span>
            <span class="text-white"> horas economizadas com Synkro</span>
          </p>
        </div>
      </main>

      <!-- Footer -->
      <footer class="border-t border-gray-800 bg-gray-900/50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <p class="text-gray-400">
            © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
          </p>
          <p class="text-sm text-gray-500 mt-2">
            Sistema de chat profissional desenvolvido com Laravel e Livewire.
          </p>
        </div>
      </footer>
    </div>
  </body>
</html>
