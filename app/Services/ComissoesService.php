<?php

namespace App\Services;

use App\Models\Proposta;
use Illuminate\Support\Collection;

class ComissoesService
{
    public function comissoesAgente($mes = null, $user = null): Collection
    {
        if (!is_null($mes) && !is_null($user)) {
            return Proposta::with(['comissao', 'user'])->where(function ($query) use ($user, $mes) {
                $query->where('user_id', $user)->whereMonth('data_digitacao', $mes);
            })->get();
        }
        if (is_null($user) && !is_null($mes)) {
            return Proposta::with(['comissao', 'user'])->whereMonth('data_digitacao', $mes)->get();
        }

        if (!is_null($user) && is_null($mes)) {
            return Proposta::with(['comissao', 'user'])->where('user_id', $user)->get();
        } else {
            return Proposta::with(['comissao', 'user'])->get();
        }
    }
}
