<?php

namespace App\Models;

use App\Enums\TipoContaEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfoBancaria extends Model
{
    use HasFactory;

    protected $table = 'info_bancarias';

    protected $casts = [
        'tipo' => TipoContaEnum::class
    ];
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
