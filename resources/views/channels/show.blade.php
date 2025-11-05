<x-app-layout>
    {{-- O header mostra o nome do canal que estamos vendo --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $channel->name }} 
            <span class="text-sm font-normal text-gray-500">(Nível {{ $channel->required_level }})</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    
                    <div class="border rounded-lg p-4 h-96 overflow-y-auto space-y-4">
                        
                        @forelse ($messages as $message)
                            {{-- Lógica de UI: Se o ID do usuário da mensagem for o meu, alinhe à direita --}}
                            <div class="flex @if(Auth::id() == $message->user_id) justify-end @else justify-start @endif">
                                
                                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                                    {{-- Nome do Autor --}}
                                    <div class="font-semibold text-sm">{{ $message->user->name }}</div>
                                    
                                    {{-- Corpo da Mensagem --}}
                                    <p class="text-gray-800">{{ $message->body }}</p>
                                    
                                    {{-- Horário (Ex: "há 5 minutos") --}}
                                    <div class="text-xs text-gray-500 text-right mt-1">
                                        {{ $message->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500">
                                <p>Este canal ainda não tem mensagens. Seja o primeiro a dizer olá!</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class->
                        <p class="text-gray-500 text-sm">Em breve: formulário para enviar mensagem.</p>
                        <p class="text-gray-400 text-xs">(Vamos implementar isso com Livewire no próximo passo)</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>