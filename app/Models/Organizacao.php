<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizacao extends Model
{
    use HasFactory;

    protected $table = 'organizacoes';

    protected $fillable = ['nome_organizacao'];

    public function vinculos(): HasMany
    {
        return $this->hasMany(Vinculo::class, 'organizacao_id', 'id');
    }
}
