<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-white mb-1">
            {{ __('Excluir Conta') }}
        </h2>
        <p class="text-sm text-gray-400">
            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão permanentemente excluídos. Antes de excluir sua conta, faça o download de quaisquer dados ou informações que deseja manter.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600/20 hover:bg-red-600/30 text-red-300 hover:text-red-200 font-semibold py-2.5 px-6 rounded-lg border border-red-500/30 transition-all duration-200"
    >{{ __('Excluir Conta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-white mb-2">
                {{ __('Tem certeza que deseja excluir sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão permanentemente excluídos. Digite sua senha para confirmar que deseja excluir permanentemente sua conta.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Senha') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="{{ __('Senha') }}"
                />

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" 
                        x-on:click="$dispatch('close')"
                        class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200 border border-gray-600">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-200">
                    {{ __('Excluir Conta') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
