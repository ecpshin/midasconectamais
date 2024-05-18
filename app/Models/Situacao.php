<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Situacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'situacoes';

    protected $fillable = ['descricao_situacao', 'motivo_situacao'];

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'situacao_id', 'id');
    }
}
