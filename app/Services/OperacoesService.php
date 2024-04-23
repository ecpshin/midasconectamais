<?php

namespace App\Services;

use App\Models\Ligacao;
use Illuminate\Database\Eloquent\Collection;

class OperacoesService
{
    public function getOperacoes(): Collection
    {
        return Ligacao::all();
    }
}