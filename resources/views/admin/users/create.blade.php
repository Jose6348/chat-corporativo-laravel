<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Criar Novo Usuário') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Adicione um novo usuário ao sistema</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nome Completo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required
                               class="input-field @error('name') border-red-500 @enderror"
                               placeholder="Ex: João Silva">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required
                               class="input-field @error('email') border-red-500 @enderror"
                               placeholder="Ex: joao@empresa.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Senha -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Senha <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               minlength="8"
                               class="input-field @error('password') border-red-500 @enderror"
                               placeholder="Mínimo 8 caracteres">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Senha -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirmar Senha <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               minlength="8"
                               class="input-field"
                               placeholder="Digite a senha novamente">
                    </div>

                    <!-- Nível de Acesso -->
                    <div>
                        <label for="access_level" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nível de Acesso <span class="text-red-500">*</span>
                        </label>
                        <select id="access_level" 
                                name="access_level" 
                                required
                                class="input-field @error('access_level') border-red-500 @enderror">
                            <option value="">Selecione um nível</option>
                            <option value="2" {{ old('access_level') == 2 ? 'selected' : '' }}>
                                Nível 2 - Diretoria (Acesso a canais nível 2, 3 e 4)
                            </option>
                            <option value="3" {{ old('access_level') == 3 ? 'selected' : '' }}>
                                Nível 3 - Gerência (Acesso a canais nível 3 e 4)
                            </option>
                            <option value="4" {{ old('access_level') == 4 ? 'selected' : '' }}>
                                Nível 4 - Colaborador (Acesso apenas a canais nível 4)
                            </option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">
                            ⚠️ Apenas administradores podem criar outros administradores via comando.
                        </p>
                        @error('access_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-primary flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Criar Usuário</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


