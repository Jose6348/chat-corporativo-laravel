<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Chat') }} - Sistema de Chat Profissional</title>

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
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <header class="w-full">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-2 rounded-lg shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                {{ config('app.name', 'Chat') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                    @auth
                                    <a href="{{ url('/dashboard') }}" class="btn-primary">
                            Dashboard
                        </a>
                    @else
                                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                                        Entrar
                                    </a>
                        @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-primary">
                                            Registrar
                            </a>
                        @endif
                    @endauth
                            @endif
                        </div>
                    </div>
                </nav>
        </header>

            <!-- Hero Section -->
            <main class="flex-1 flex items-center justify-center px-4 py-12">
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left space-y-8">
                        <div class="space-y-4">
                            <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                                <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Chat Profissional
                                </span>
                                <br>
                                <span class="text-gray-800">para sua Empresa</span>
                            </h1>
                            <p class="text-xl text-gray-600 leading-relaxed">
                                Sistema de comunicação em tempo real com canais organizados, mensagens instantâneas e interface moderna.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                    Acessar Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Começar Agora
                                </a>
                                <a href="{{ route('login') }}" class="btn-secondary text-lg px-8 py-4 inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Entrar
                                </a>
                            @endauth
                        </div>

                        <!-- Features -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-8">
                            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 shadow-md border border-gray-200">
                                <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center mb-3 mx-auto lg:mx-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800 mb-1">Tempo Real</h3>
                                <p class="text-sm text-gray-600">Mensagens instantâneas com WebSocket</p>
                </div>
                            
                            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 shadow-md border border-gray-200">
                                <div class="bg-indigo-100 w-12 h-12 rounded-lg flex items-center justify-center mb-3 mx-auto lg:mx-0">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800 mb-1">Canais</h3>
                                <p class="text-sm text-gray-600">Organize por equipes e projetos</p>
                            </div>
                            
                            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 shadow-md border border-gray-200">
                                <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mb-3 mx-auto lg:mx-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-800 mb-1">Seguro</h3>
                                <p class="text-sm text-gray-600">Autenticação e níveis de acesso</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Visual -->
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-300">
                            <!-- Chat Preview -->
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                                <!-- Chat Header -->
                                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-white font-semibold">Canal Geral</h3>
                                            <p class="text-blue-100 text-sm">3 membros online</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Messages Preview -->
                                <div class="p-6 space-y-4 bg-gray-50 min-h-[300px]">
                                    <!-- Message 1 -->
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            J
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                                                <p class="text-sm font-semibold text-gray-700 mb-1">João Silva</p>
                                                <p class="text-sm text-gray-800">Olá pessoal! Como está o projeto?</p>
                                                <p class="text-xs text-gray-500 mt-2">10:30</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Message 2 -->
                                    <div class="flex items-start space-x-3 justify-end">
                                        <div class="flex-1 flex justify-end">
                                            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl rounded-tr-md px-4 py-3 shadow-md max-w-[80%]">
                                                <p class="text-sm font-semibold text-blue-100 mb-1">Você</p>
                                                <p class="text-sm">Tudo certo! Vamos finalizar hoje.</p>
                                                <p class="text-xs text-blue-100 mt-2">10:32</p>
                                            </div>
                                        </div>
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            V
                                        </div>
                                    </div>
                                    
                                    <!-- Message 3 -->
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            M
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                                                <p class="text-sm font-semibold text-gray-700 mb-1">Maria Santos</p>
                                                <p class="text-sm text-gray-800">Perfeito! Estou enviando os arquivos agora.</p>
                                                <p class="text-xs text-gray-500 mt-2">10:33</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Input -->
                                <div class="bg-white border-t border-gray-200 p-4">
                                    <div class="flex items-center space-x-3">
                                        <input type="text" placeholder="Digite sua mensagem..." class="flex-1 input-field" disabled>
                                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Elements -->
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full opacity-20 blur-2xl"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-pink-400 rounded-full opacity-20 blur-2xl"></div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="text-gray-600 mb-2">
                            © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                        </p>
                        <p class="text-sm text-gray-500">
                            Sistema de chat profissional desenvolvido com Laravel e Livewire
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
