<x-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Detalhes do Usuário</h2>
                <p class="text-gray-400">Informações completas do usuário</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Editar</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 border border-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Voltar</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Informações Principais -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informações Pessoais
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Nome Completo</dt>
                            <dd class="mt-1 text-sm text-white font-medium">{{ $user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Email</dt>
                            <dd class="mt-1 text-sm text-white font-medium">{{ $user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Nível de Acesso</dt>
                            <dd class="mt-1">
                                @php
                                    $levelNames = [
                                        1 => ['name' => 'Admin/C-Level', 'color' => 'bg-red-500/20 text-red-300 border-red-500/30'],
                                        2 => ['name' => 'Diretoria', 'color' => 'bg-purple-500/20 text-purple-300 border-purple-500/30'],
                                        3 => ['name' => 'Gerência', 'color' => 'bg-blue-500/20 text-blue-300 border-blue-500/30'],
                                        4 => ['name' => 'Colaborador', 'color' => 'bg-gray-500/20 text-gray-300 border-gray-500/30'],
                                    ];
                                    $level = $levelNames[$user->access_level] ?? $levelNames[4];
                                @endphp
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full border {{ $level['color'] }}">
                                    Nível {{ $user->access_level }} - {{ $level['name'] }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informações da Conta
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Conta criada em</dt>
                            <dd class="mt-1 text-sm text-white font-medium">{{ $user->created_at->format('d/m/Y \à\s H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Última atualização</dt>
                            <dd class="mt-1 text-sm text-white font-medium">{{ $user->updated_at->format('d/m/Y \à\s H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-400">Email verificado</dt>
                            <dd class="mt-1">
                                @if($user->email_verified_at)
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-500/20 text-green-300 border border-green-500/30">
                                        Verificado em {{ $user->email_verified_at->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">
                                        Não verificado
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-3xl mx-auto mb-4 shadow-lg ring-2 ring-gray-600">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-lg font-bold text-white">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-400 mt-1">{{ $user->email }}</p>
                    </div>
                </div>

                @if($user->access_level !== 1)
                    <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Ações Rápidas</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="block w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 text-center shadow-lg hover:shadow-xl">
                                Editar Usuário
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600/20 hover:bg-red-600/30 text-red-300 hover:text-red-200 font-semibold py-2.5 px-6 rounded-lg border border-red-500/30 transition-all duration-200">
                                    Excluir Usuário
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>
