<?php

namespace App\Services;

use App\Models\Ligacao;
use Illuminate\Database\Eloquent\Collection;

class LigacoesService
{
    public function getListaGoverno($user = null): Collection
    {
        $collection = Ligacao::where(function ($query) {
            return $query->where('orgao', 'LIKE', '%GOVERNO%')->whereNot('orgao', 'LIKE', '%Pref%')->whereNull('user_id');
        })->whereNull('user_id')->get();
        return $collection->random(100);
    }

    public function getListaPrefeitura($user = null): Collection
    {
        $collection = Ligacao::where('user_id', $user)->where(function ($query) {
            $query->where('orgao', 'LIKE', 'Pref%')->whereNot('orgao', 'LIKE', '%GOVERNO%');
        })->whereNull('user_id')->get();
        return $collection->random(100);
    }

    public function ligacoesAgente($inicio = null, $fim = null, $user = null): Collection
    {
        return Ligacao::where('user_id', $user)
            ->where(function ($query) use ($inicio, $fim) {
                $query->whereDate('data_ligacao', '>=', $inicio)
                    ->whereDate('data_ligacao', '<=', $fim);
            })->get();
    }
}
