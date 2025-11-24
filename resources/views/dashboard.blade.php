<x-dashboard-layout>
    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-900/50 border border-green-700 rounded-lg text-green-300 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Admin Actions (Level 1 only) -->
    @if (Auth::user()->access_level == 1)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gradient-to-br from-gray-800 to-gray-700 rounded-xl p-6 border border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Central de Usuários</h3>
                        <p class="text-sm text-gray-400">Crie e gerencie usuários dos níveis 2, 3 e 4</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Gerenciar</span>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-800 to-gray-700 rounded-xl p-6 border border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-1">Criar Novo Canal</h3>
                        <p class="text-sm text-gray-400">Crie salas de chat e escolha os níveis</p>
                    </div>
                    <a href="{{ route('channels.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Criar</span>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Channels Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($channels as $channel)
            <div class="group relative bg-gradient-to-br from-gray-800 to-gray-700 rounded-xl p-6 border border-gray-600 hover:border-cyan-500 hover:shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 transform hover:-translate-y-1">
                <a href="{{ route('channels.show', $channel) }}" class="block">
                <!-- Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-gradient-to-br from-purple-500 to-cyan-500 p-3 rounded-lg">
                        <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-8 h-8 object-contain filter brightness-0 invert">
                    </div>
                    <span class="px-3 py-1 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 text-cyan-300 text-xs font-semibold rounded-full border border-cyan-500/30">
                        @if($channel->allowed_levels && count($channel->allowed_levels) > 0)
                            Níveis {{ implode(', ', $channel->allowed_levels) }}
                        @else
                            Nível {{ $channel->required_level }}
                        @endif
                    </span>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <h4 class="font-bold text-lg text-white mb-2 group-hover:text-cyan-400 transition-colors">
                        {{ $channel->name }}
                    </h4>
                    <p class="text-sm text-gray-400 line-clamp-2">
                        {{ $channel->description ?? 'Canal de comunicação' }}
                    </p>
                </div>

                <!-- Mini Chart Area (decorativo) -->
                <div class="h-16 mb-4 bg-gradient-to-t from-purple-500/10 via-cyan-500/10 to-transparent rounded-lg relative overflow-hidden">
                    <svg class="absolute bottom-0 left-0 right-0 h-full" viewBox="0 0 200 60" preserveAspectRatio="none">
                        <path d="M0,60 Q50,40 100,45 T200,35 L200,60 Z" fill="url(#gradient-{{ $channel->id }})" opacity="0.6"/>
                        <defs>
                            <linearGradient id="gradient-{{ $channel->id }}" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#06b6d4;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-600">
                    <div class="flex items-center text-cyan-400 text-sm font-medium group-hover:translate-x-1 transition-transform">
                        <span>Entrar no canal</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                </a>
                
                <!-- Botão de Deletar (apenas para admin nível 1) -->
                @if (Auth::user()->access_level == 1)
                    <form action="{{ route('channels.destroy', $channel) }}" 
                          method="POST" 
                          class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity"
                          onsubmit="return confirm('Tem certeza que deseja excluir este canal? Todas as mensagens serão perdidas.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="p-2 bg-red-600/20 hover:bg-red-600/30 text-red-300 hover:text-red-200 rounded-lg border border-red-500/30 transition-all duration-200"
                                title="Excluir canal"
                                onclick="event.stopPropagation();">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-gradient-to-br from-gray-800 to-gray-700 rounded-xl border border-gray-600">
                    <div class="bg-gradient-to-br from-purple-500/20 to-cyan-500/20 rounded-full p-8 w-32 h-32 mx-auto mb-6 flex items-center justify-center">
                        <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-16 h-16 object-contain opacity-50 filter brightness-0 invert">
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Nenhum canal disponível</h3>
                    <p class="text-gray-400 mb-6">Você ainda não tem acesso a nenhum canal no momento.</p>
                    @if (Auth::user()->access_level == 1)
                        <a href="{{ route('channels.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Criar Primeiro Canal</span>
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Floating Action Button (Mobile) -->
    @if (Auth::user()->access_level == 1)
        <a href="{{ route('channels.create') }}" class="fixed bottom-6 right-6 md:hidden bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 z-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </a>
    @endif
</x-dashboard-layout>
