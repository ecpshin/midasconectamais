<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vinculo extends Model
{
    use HasFactory;

    protected $table = 'vinculos';

    protected $fillable = ['cliente_id', 'organizacao_id', 'nrbeneficio', 'email', 'senha'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_id', 'id');
    }
}
