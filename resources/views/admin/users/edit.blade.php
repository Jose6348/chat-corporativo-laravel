<x-dashboard-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Editar Usuário</h2>
                <p class="text-gray-400">Atualize as informações do usuário</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 border border-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Voltar</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">
                        Nome Completo <span class="text-red-400">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Ex: João Silva">
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">
                        Email <span class="text-red-400">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500 @enderror"
                           placeholder="Ex: joao@empresa.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Senha -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">
                        Nova Senha <span class="text-gray-500 text-xs">(deixe em branco para manter a atual)</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           minlength="8"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('password') border-red-500 @enderror"
                           placeholder="Mínimo 8 caracteres">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-2">
                        Confirmar Nova Senha
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           minlength="8"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="Digite a senha novamente">
                </div>

                <!-- Nível de Acesso -->
                <div>
                    <label for="access_level" class="block text-sm font-semibold text-gray-300 mb-2">
                        Nível de Acesso <span class="text-red-400">*</span>
                    </label>
                    @if($user->access_level === 1)
                        <div class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                            Nível 1 - Admin/C-Level (não pode ser alterado)
                        </div>
                        <input type="hidden" name="access_level" value="1">
                    @else
                        <select id="access_level" 
                                name="access_level" 
                                required
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('access_level') border-red-500 @enderror">
                            <option value="2" {{ old('access_level', $user->access_level) == 2 ? 'selected' : '' }}>
                                Nível 2 - Diretoria (Acesso a canais nível 2, 3 e 4)
                            </option>
                            <option value="3" {{ old('access_level', $user->access_level) == 3 ? 'selected' : '' }}>
                                Nível 3 - Gerência (Acesso a canais nível 3 e 4)
                            </option>
                            <option value="4" {{ old('access_level', $user->access_level) == 4 ? 'selected' : '' }}>
                                Nível 4 - Colaborador (Acesso apenas a canais nível 4)
                            </option>
                        </select>
                    @endif
                    @error('access_level')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 border border-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Salvar Alterações</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
