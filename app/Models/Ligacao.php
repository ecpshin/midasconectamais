<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ligacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ligacoes';

    protected $fillable = [
        'user_id',
        'status_id',
        'organizacao_id',
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

    public function situacao(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    protected $casts = [
        'data_ligacao' => 'date',
        'data_agendamento' => 'date'
    ];
}
