<x-dashboard-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white mb-1">Criar Novo Canal</h2>
                <p class="text-gray-400">Crie uma nova sala de chat e escolha quais níveis podem participar</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 border border-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Voltar</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-xl p-6">
            <form action="{{ route('channels.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nome do Canal -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">
                        Nome do Canal <span class="text-red-400">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Ex: Reunião de Planejamento">
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-300 mb-2">
                        Descrição
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none @error('description') border-red-500 @enderror"
                              placeholder="Descreva o propósito deste canal...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Níveis Permitidos -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Níveis que podem participar <span class="text-red-400">*</span>
                    </label>
                    <p class="text-sm text-gray-400 mb-3">
                        Selecione quais níveis de acesso podem visualizar e participar deste canal.
                    </p>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-3 p-3 border border-gray-600 rounded-lg hover:bg-gray-700/50 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="allowed_levels[]" 
                                   value="1"
                                   {{ in_array(1, old('allowed_levels', [])) ? 'checked' : '' }}
                                   class="w-4 h-4 text-cyan-500 bg-gray-700 border-gray-600 rounded focus:ring-cyan-500 focus:ring-2">
                            <div>
                                <span class="font-semibold text-white">Nível 1 - Administrador</span>
                                <p class="text-sm text-gray-400">Acesso administrativo completo</p>
                            </div>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border border-gray-600 rounded-lg hover:bg-gray-700/50 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="allowed_levels[]" 
                                   value="2"
                                   {{ in_array(2, old('allowed_levels', [])) ? 'checked' : '' }}
                                   class="w-4 h-4 text-cyan-500 bg-gray-700 border-gray-600 rounded focus:ring-cyan-500 focus:ring-2">
                            <div>
                                <span class="font-semibold text-white">Nível 2 - Diretoria</span>
                                <p class="text-sm text-gray-400">Gestores e diretores</p>
                            </div>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border border-gray-600 rounded-lg hover:bg-gray-700/50 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="allowed_levels[]" 
                                   value="3"
                                   {{ in_array(3, old('allowed_levels', [])) ? 'checked' : '' }}
                                   class="w-4 h-4 text-cyan-500 bg-gray-700 border-gray-600 rounded focus:ring-cyan-500 focus:ring-2">
                            <div>
                                <span class="font-semibold text-white">Nível 3 - Gerência</span>
                                <p class="text-sm text-gray-400">Gerentes e coordenadores</p>
                            </div>
                        </label>
                        <label class="flex items-center space-x-3 p-3 border border-gray-600 rounded-lg hover:bg-gray-700/50 cursor-pointer transition-colors">
                            <input type="checkbox" 
                                   name="allowed_levels[]" 
                                   value="4"
                                   {{ in_array(4, old('allowed_levels', [])) ? 'checked' : '' }}
                                   class="w-4 h-4 text-cyan-500 bg-gray-700 border-gray-600 rounded focus:ring-cyan-500 focus:ring-2">
                            <div>
                                <span class="font-semibold text-white">Nível 4 - Colaborador</span>
                                <p class="text-sm text-gray-400">Colaboradores em geral</p>
                            </div>
                        </label>
                    </div>
                    @error('allowed_levels')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('allowed_levels.*')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 border border-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Criar Canal</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
