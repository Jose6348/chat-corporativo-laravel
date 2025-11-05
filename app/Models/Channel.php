<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importar
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory; // Usar

    protected $fillable = [ 
        'name',
        'description',
        'required_level',
    ];

    /**
     * Um canal pode ter muitas mensagens.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}