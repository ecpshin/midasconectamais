<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operacao extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['descricao_produto'];

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'operacao_id', 'id');
    }
}
