<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comissao extends Model
{
    use HasFactory;

    protected $table = 'comissoes';

    protected $fillable = [
        'proposta_id',
        'tabela_id',
        'data_repasse',
        'percentual_loja',
        'valor_loja',
        'percentual_agente',
        'valor_agente',
        'percentual_corretor',
        'valor_corretor',
        'is_pago'
    ];

    protected $casts = [
        'data_repasse' => 'date'
    ];

    public function proposta(): BelongsTo
    {
        return $this->belongsTo(Proposta::class, 'proposta_id', 'id');
    }

    public function tabela(): BelongsTo
    {
        return $this->belongsTo(Tabela::class, 'tabela_id', 'id');
    }
}
