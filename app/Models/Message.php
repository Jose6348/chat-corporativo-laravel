<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory; // Usar

    protected $fillable = [ 
        'user_id',
        'channel_id',
        'body',
    ];

    /**
     * Uma mensagem pertence a um usuário (autor).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Uma mensagem pertence a um canal.
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}