<?php

namespace App\Services;

use App\Models\Proposta;
use App\Models\User;
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

    public function propostas($user = null): Collection
    {
        return (is_null($user)) ? Proposta::orderBy('data_digitacao', 'desc')->get() : Proposta::where('user_id', $user)->orderByDesc('data_digitacao')->get();
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
