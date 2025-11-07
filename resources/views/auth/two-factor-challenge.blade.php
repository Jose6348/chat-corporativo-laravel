<x-guest-layout>
    {{-- Texto de instrução para o usuário --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Enviamos um código de verificação para o seu e-mail. Por favor, digite o código para continuar.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- O formulário envia para a nova rota '2fa.verify' --}}
    <form method="POST" action="{{ route('2fa.verify') }}">
        @csrf

        <div>
            <x-input-label for="code" :value="__('Código de 6 dígitos')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verificar e Continuar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>