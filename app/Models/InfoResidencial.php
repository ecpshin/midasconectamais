<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfoResidencial extends Model
{
    use HasFactory;

    protected $table = 'info_residenciais';

    protected $fillable = ['cliente_id', 'cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
