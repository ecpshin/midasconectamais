<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Number;

class Tabela extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tabelas';

    protected $fillable = [
        'descricao',
        'codigo',
        'financeira_id',
        'correspondente_id',
        'organizacao_id',
        'produto_id',
        'percentual_loja',
        'percentual_agente',
        'percentual_corretor',
        'parcelado',
        'referencia'
    ];

    public function correspondente(): BelongsTo
    {
        return $this->belongsTo(Correspondente::class, 'correspondente_id', 'id');
    }

    public function financeira(): BelongsTo
    {
        return $this->belongsTo(Financeira::class, 'financeira_id', 'id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class);
    }

    public function comissao(): HasOne
    {
        return $this->hasOne(Comissao::class, 'tabela_id', 'id');
    }
}
