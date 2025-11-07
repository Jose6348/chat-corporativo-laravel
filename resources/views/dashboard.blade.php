<x-app-layout>
    {{-- Header (Cabeçalho) da página --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Canais de Chat') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Selecione um canal para começar a conversar</p>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (Auth::user()->access_level == 1)
                <div class="card bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="space-y-1">
                            <h3 class="text-lg font-bold text-gray-800">Central de Usuários</h3>
                            <p class="text-sm text-gray-600">Crie e gerencie usuários dos níveis 2, 3 e 4 diretamente pelo painel.</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('admin.users.index') }}" class="btn-primary inline-flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Gerenciar Usuários</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                        <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-6 h-6 mr-2 object-contain">
                        Seus Canais Disponíveis
                    </h3>
                    <p class="text-gray-600">Escolha um canal abaixo para participar da conversa</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($channels as $channel)
                        <a href="{{ route('channels.show', $channel) }}" class="group block p-6 bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="bg-white p-2 rounded-lg shadow-md group-hover:shadow-lg transition-shadow">
                                    <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-8 h-8 object-contain">
                                </div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                    Nível {{ $channel->required_level }}
                                </span>
                            </div>
                            <h4 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $channel->name }}
                            </h4>
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $channel->description ?? 'Canal de comunicação' }}
                            </p>
                            <div class="mt-4 flex items-center text-blue-600 text-sm font-medium group-hover:translate-x-1 transition-transform">
                                Entrar no canal
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-12">
                                <div class="bg-gray-100 rounded-full p-6 w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                                    <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-12 h-12 object-contain opacity-70">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Nenhum canal disponível</h3>
                                <p class="text-gray-600">Você ainda não tem acesso a nenhum canal no momento.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>