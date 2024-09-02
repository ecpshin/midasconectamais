<?php

namespace App\Models;

use App\Casts\PercentualCast;
use App\Casts\TotalCast;
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
        'valor_loja' => TotalCast::class,
        'valor_agente' => TotalCast::class,
        'valor_corretor' => TotalCast::class,
        'percentual_loja' => PercentualCast::class,
        'percentual_agente' => PercentualCast::class,
        'percentual_corretor' => PercentualCast::class,
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
