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
        'produto',
        'percentual_loja',
        'percentual_agente',
        'percentual_corretor',
        'correspondente_id',
        'financeira_id',
        'parcelado'
    ];

    public function correspondente(): BelongsTo
    {
        return $this->belongsTo(Correspondente::class, 'correspondente_id', 'id');
    }

    public function financeira(): BelongsTo
    {
        return $this->belongsTo(Financeira::class, 'financeira_id', 'id');
    }

    public function comissao(): HasOne
    {
        return $this->hasOne(Comissao::class, 'tabela_id', 'id');
    }
}
