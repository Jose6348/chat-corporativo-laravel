<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

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
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 p-4 rounded-2xl shadow-xl mb-4 transform hover:scale-105 transition-transform">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ config('app.name', 'Chat') }}
                </h1>
                <p class="text-gray-600 mt-2">Sistema de Chat Profissional</p>
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
