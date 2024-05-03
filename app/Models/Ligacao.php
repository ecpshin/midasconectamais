<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ligacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ligacoes';

    protected $fillable = [
        'organizacao_id',
        'produto_id',
        'status_id',
        'user_id',
        'data_ligacao',
        'data_agendamento',
        'nome',
        'cpf',
        'matricula',
        'orgao',
        'margem',
        'telefone',
        'produto',
        'observacoes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_id', 'id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    protected $casts = [
        'data_ligacao' => 'date',
        'data_agendamento' => 'date'
    ];
}
