<x-guest-layout>
    <div class="space-y-10">
        <div class="space-y-2">
            <h1 class="text-3xl font-semibold text-slate-900">{{ __('Bem-vindo de volta') }}</h1>
            <p class="text-sm text-slate-500">{{ __('Entre com suas credenciais para acessar o painel.') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-sm text-emerald-700" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="sr-only">{{ __('Email') }}</label>
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400 transition-colors group-focus-within:text-slate-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-text-input
                        id="email"
                        class="w-full rounded-xl border border-slate-200 bg-white/60 py-3 pl-12 pr-4 text-base text-slate-900 shadow-sm outline-none transition-all duration-200 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Usuário"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="sr-only">{{ __('Senha') }}</label>
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400 transition-colors group-focus-within:text-slate-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-text-input
                        id="password"
                        class="w-full rounded-xl border border-slate-200 bg-white/60 py-3 pl-12 pr-12 text-base text-slate-900 shadow-sm outline-none transition-all duration-200 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Senha"
                    />
                    <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path>
                            <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                        </svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center gap-2 text-slate-600">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-slate-700 focus:ring-slate-400" name="remember">
                    <span>{{ __('Lembrar-me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="font-medium text-slate-600 transition-colors hover:text-slate-900" href="{{ route('password.request') }}">
                        {{ __('Esqueceu a senha?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-base font-semibold uppercase tracking-wide text-white shadow-lg shadow-slate-900/20 transition-transform duration-200 hover:-translate-y-0.5 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/60 focus-visible:ring-offset-2 focus-visible:ring-offset-white">
                {{ __('Entrar') }}
            </button>
        </form>
    </div>
</x-guest-layout>