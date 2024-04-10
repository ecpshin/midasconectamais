<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proposta extends Model
{
    use HasFactory;

    protected $table = 'propostas';

    protected $fillable = [
        'uuid',
        'data_digitacao',
        'data_pagamento',
        'numero_contrato',
        'prazo_proposta',
        'total_proposta',
        'parcela_proposta',
        'liquido_proposta',
        'cliente_id',
        'operacao_id',
        'financeira_id',
        'correspondente_id',
        'situacao_id',
        'user_id'
    ];

    protected $casts = [
        'data_digitacao' => 'date',
        'data_pagamento' => 'date',
    ];

    public function comissao(): HasOne
    {
        return $this->hasOne(Comissao::class, 'proposta_id', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function correspondente(): BelongsTo
    {
        return $this->belongsTo(Correspondente::class, 'correspondente_id', 'id');
    }

    public function financeira(): BelongsTo
    {
        return $this->belongsTo(Financeira::class, 'financeira_id', 'id');
    }

    public function operacao(): BelongsTo
    {
        return $this->belongsTo(Operacao::class, 'operacao_id', 'id');
    }

    public function situacao(): BelongsTo
    {
        return $this->belongsTo(Situacao::class, 'situacao_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
