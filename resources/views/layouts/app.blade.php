<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Synkro Chat') }} - Comunicação Interna</title>

    <link rel="icon" type="image/png" href="{{ asset('logo-synkro.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos do Livewire -->
    @livewireStyles
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <x-navigation />
        
        <!-- Main Content -->
        <main class="flex-1">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="py-6">
                {{ $slot }}
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    © {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                </p>
            </div>
        </footer>
    </div>

    <x-chatbot-helper />

    <!-- Scripts do Livewire -->
    @livewireScripts
    @stack('scripts')
</body>

</html>