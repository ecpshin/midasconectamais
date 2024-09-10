<?php

namespace App\Models;

use App\Casts\PercentualCast;
use App\Casts\ValorCast;
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
        'percentual_agente',
        'percentual_corretor',
        'valor_loja',
        'valor_agente',
        'valor_corretor',
        'is_pago'
    ];

    protected $casts = [
        'data_repasse' => 'date',
        'valor_loja' => ValorCast::class,
        'valor_agente' => ValorCast::class,
        'valor_corretor' => ValorCast::class,
        'percentual_loja' => ValorCast::class,
        'percentual_agente' => ValorCast::class,
        'percentual_corretor' => ValorCast::class,
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
