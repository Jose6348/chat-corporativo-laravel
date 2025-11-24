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
        'allowed_levels',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'allowed_levels' => 'array',
    ];

    /**
     * Um canal pode ter muitas mensagens.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Verifica se um nível de acesso pode visualizar este canal.
     */
    public function allowsLevel(int $level): bool
    {
        // Se allowed_levels estiver definido, usa ele
        if ($this->allowed_levels !== null && is_array($this->allowed_levels)) {
            return in_array($level, $this->allowed_levels);
        }
        
        // Caso contrário, usa o comportamento antigo (required_level)
        return $level <= $this->required_level;
    }
}