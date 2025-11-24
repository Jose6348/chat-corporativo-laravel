<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ChannelController extends Controller
{
    use AuthorizesRequests;
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $allChannels = Channel::all();

        $allowedChannels = $allChannels->filter(function ($channel) use ($user) {
            return $user->can('view', $channel);
        });

        return view('dashboard', ['channels' => $allowedChannels]);
    }

    public function create(): View
    {
        $this->authorize('create', Channel::class);

        return view('channels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Channel::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'allowed_levels' => ['required', 'array', 'min:1'],
            'allowed_levels.*' => ['required', 'integer', 'in:1,2,3,4'],
        ]);

        Channel::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'allowed_levels' => $validated['allowed_levels'],
            'required_level' => min($validated['allowed_levels']), // Mantém compatibilidade
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Canal criado com sucesso!');
    }

    public function show(Channel $channel): View
    {
        $this->authorize('view', $channel);

        $messages = $channel->messages()->with('user')->get();

        return view('channels.show', [
            'channel' => $channel,
            'messages' => $messages
        ]);
    }

    public function edit(Channel $channel)
    {
        //
    }

    public function update(Request $request, Channel $channel)
    {
        //
    }

    public function destroy(Channel $channel): RedirectResponse
    {
        $this->authorize('delete', $channel);

        // Deleta todas as mensagens do canal primeiro (cascade)
        $channel->messages()->delete();

        // Deleta o canal
        $channel->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Canal excluído com sucesso!');
    }
}