<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'rg',
        'orgao_exp',
        'data_exp',
        'naturalidade',
        'genitora',
        'genitor',
        'sexo',
        'estado_civil',
        'phone1',
        'phone2',
        'phone3',
        'phone4',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $casts = [
        'data_nascimento' => 'date',
        'data_exp' => 'date'
    ];
    public function infoBancarias(): HasMany
    {
        return $this->hasMany(InfoBancaria::class, 'cliente_id', 'id');
    }

    public function vinculos(): HasMany
    {
        return $this->hasMany(Vinculo::class, 'cliente_id', 'id');
    }

    public function infoResidencial(): HasOne
    {
        return $this->hasOne(InfoResidencial::class, 'cliente_id', 'id');
    }

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'cliente_id', 'id');
    }

    public function arquivosCliente(): HasMany
    {
        return $this->hasMany(ArquivoCliente::class, 'cliente_id', 'id');
    }
}
