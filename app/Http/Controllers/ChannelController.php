<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function destroy(Channel $channel)
    {
        //
    }
}