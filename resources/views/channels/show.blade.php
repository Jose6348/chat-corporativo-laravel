<x-app-layout>
    {{-- O header mostra o nome do canal que estamos vendo --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        {{ $channel->name }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Nível {{ $channel->required_level }} • {{ $channel->description ?? 'Canal de comunicação' }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-0 overflow-hidden">
                <livewire:chat-room :channel="$channel" :key="$channel->id" wire:poll.2s />
            </div>
        </div>
    </div>
</x-app-layout>