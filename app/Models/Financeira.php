<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Financeira extends Model
{
    use HasFactory;

    protected $table = 'financeiras';

    protected $fillable = ['nome_financeira'];

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'financeira_id', 'id');
    }

    public function tabelas(): HasMany
    {
        return $this->hasMany(Tabela::class, 'financeira_id', 'id');
    }
}
