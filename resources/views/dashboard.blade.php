<x-app-layout>
    {{-- Header (Cabeçalho) da página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Canais de Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Seus Canais Disponíveis</h3>
                    
                    <div class="space-y-4">
                        {{-- 
                          O @forelse é um loop. Ele vai iterar em '$channels'.
                          Se '$channels' estiver vazio, ele mostra a seção @empty.
                        --}}
                        @forelse ($channels as $channel)
                            {{-- Cada canal é um link para a rota 'channels.show' --}}
                            <a href="{{ route('channels.show', $channel) }}" class="block p-4 border rounded-lg hover:bg-gray-100 transition duration-150">
                                <h4 class="font-semibold text-blue-600">{{ $channel->name }} (Nível {{ $channel->required_level }})</h4>
                                <p class="text-sm text-gray-600">{{ $channel->description }}</p>
                            </a>
                        @empty
                            {{-- Mensagem se o usuário não tiver canais (Ex: Nível 4 e não há canais Nível 4) --}}
                            <p class="text-gray-500">Você ainda não tem acesso a nenhum canal.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>