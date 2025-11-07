<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Detalhes do Usuário') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Informações completas do usuário</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn-primary flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Editar</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Voltar</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informações Principais -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="card">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informações Pessoais
                        </h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nome Completo</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nível de Acesso</dt>
                                <dd class="mt-1">
                                    @php
                                        $levelNames = [
                                            1 => ['name' => 'Admin/C-Level', 'color' => 'bg-red-100 text-red-800'],
                                            2 => ['name' => 'Diretoria', 'color' => 'bg-purple-100 text-purple-800'],
                                            3 => ['name' => 'Gerência', 'color' => 'bg-blue-100 text-blue-800'],
                                            4 => ['name' => 'Colaborador', 'color' => 'bg-gray-100 text-gray-800'],
                                        ];
                                        $level = $levelNames[$user->access_level] ?? $levelNames[4];
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $level['color'] }}">
                                        Nível {{ $user->access_level }} - {{ $level['name'] }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="card">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informações da Conta
                        </h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Conta criada em</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y \à\s H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Última atualização</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y \à\s H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email verificado</dt>
                                <dd class="mt-1">
                                    @if($user->email_verified_at)
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Verificado em {{ $user->email_verified_at->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
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
                    <div class="card">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-3xl mx-auto mb-4 shadow-lg">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $user->email }}</p>
                        </div>
                    </div>

                    @if($user->access_level !== 1)
                        <div class="card">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ações Rápidas</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-primary w-full text-center">
                                    Editar Usuário
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger w-full">
                                        Excluir Usuário
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


