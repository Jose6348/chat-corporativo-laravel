<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Synkro Chat') }} - Login</title>

        <link rel="icon" type="image/png" href="{{ asset('logo-synkro.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Logo e Título -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <div class="bg-white p-4 rounded-2xl shadow-xl mb-4 transform hover:scale-105 transition-transform">
                        <img src="{{ asset('logo-synkro.png') }}" alt="Logo Synkro" class="w-16 h-16 object-contain">
                    </div>
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ config('app.name', 'Synkro Chat') }}
                </h1>
                <p class="text-gray-600 mt-2">Conexão segura para sua equipe</p>
            </div>

            <!-- Card de Login -->
            <div class="w-full sm:max-w-md">
                <div class="bg-white/80 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Bem-vindo de volta</h2>
                        <p class="text-blue-100 text-sm">Entre para continuar</p>
                    </div>
                    <div class="px-6 py-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
