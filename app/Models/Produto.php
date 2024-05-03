<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = ['descricao_produto'];

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class);
    }

    public function tabelas(): HasMany
    {
        return $this->hasMany(Tabela::class);
    }

    public function ligacoes(): HasMany
    {
        return $this->hasMany(Ligacao::class);
    }
}
