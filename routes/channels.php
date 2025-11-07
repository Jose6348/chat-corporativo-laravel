<?php

use App\Models\Channel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{channelId}', function ($user, $channelId) {
    $channel = Channel::find($channelId);

    if (!$channel) {
        return false;
    }

    // Retorna informações do usuário autenticado (requisito para canais privados)
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});
