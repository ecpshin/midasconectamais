<?php

namespace App\Services;

use App\Models\Proposta;
use Illuminate\Database\Eloquent\Collection;

class PropostaService
{
    public function propostasPorIntervalo($inicio, $fim): Collection
    {
        return Proposta::where(function ($query) use ($inicio, $fim) {
            $query->whereDate('data_digitacao', '>=', $inicio)->whereDate('data_digitacao', '<=', $fim);
        })->get();
    }

    public function propostasPorIntervaloUsuario($inicio = null, $fim = null, $user = null): Collection
    {
        return Proposta::where(function ($query) use ($inicio, $fim) {
            $query->whereDate('data_digitacao', '>=', $inicio)->whereDate('data_digitacao', '<=', $fim);
        })->where('user_id', $user)->get();
    }

    public function somaTotais($propostas)
    {
        return $propostas->sum('total_proposta');
    }

    public function somaLiquidos($propostas)
    {
        return $propostas->sum('liquido_proposta');
    }
}
