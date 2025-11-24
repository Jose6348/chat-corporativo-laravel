<x-dashboard-layout>
    <!-- Chat Container -->
    <div class="h-[calc(100vh-8rem)] flex flex-col bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-2xl">
        <livewire:chat-room :channel="$channel" :key="$channel->id" wire:poll.2s />
    </div>
</x-dashboard-layout>
