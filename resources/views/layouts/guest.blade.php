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
    <body class="font-sans text-slate-900 antialiased bg-white">
        <div class="min-h-screen w-full flex flex-col lg:flex-row">
            <div class="order-2 lg:order-1 flex-1 flex items-center justify-center px-6 sm:px-12 py-12">
                <div class="w-full max-w-lg">
                    <div class="mb-12">
                        <a href="/" class="inline-flex items-center gap-4">
                            <span class="inline-flex h-16 w-16 items-center justify-center">
                                <img src="{{ asset('logo-synkro.png') }}" alt="Logo {{ config('app.name', 'Synkro Chat') }}" class="h-full w-full object-contain">
                            </span>
                            <div class="flex flex-col">
                                <span class="text-3xl font-bold tracking-tight">{{ config('app.name', 'Synkro Chat') }}</span>
                                <span class="text-sm text-slate-500">Conecte-se ao seu hub de conversas</span>
                            </div>
                        </a>
                    </div>
                    <div class="space-y-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 relative hidden lg:flex lg:w-1/2 overflow-hidden">
                <img src="{{ asset('image 1.png') }}" alt="Workspace" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-white/15 backdrop-blur-[1px]"></div>
            </div>
        </div>
    </body>
</html>
