<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mailing extends Model
{
    use HasFactory;

    protected $table = 'mailings';

    protected $fillable = ['data_consulta', 'nome', 'cpf', 'matricula', 'orgao', 'margem', 'observacoes', 'user_id'];

    protected $casts = ['data_consulta' => 'date'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
