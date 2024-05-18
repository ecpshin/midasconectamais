<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Correspondente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'correspondentes';

    protected $fillable = ['nome_correspondente', 'nome_responsavel', 'phone_contato', 'cpf_cnpj', 'percentual_comissao'];

    /**
     * @return HasMany
     */
    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'correspondente_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function tabelas(): HasMany
    {
        return $this->hasMany(Tabela::class, 'correspondente_id', 'id');
    }
}
