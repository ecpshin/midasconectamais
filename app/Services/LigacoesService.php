<?php

namespace App\Services;

use App\Models\Ligacao;
use App\Models\User;
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
        $collection = Ligacao::where('orgao', 'LIKE', 'Pref%')->whereNull('user_id')->get();
        return $collection->random(100);
    }

    public function ligacoesAgente($data = null, $user = null): Collection
    {

        if (!is_null($data) && !is_null($user)) {
            return Ligacao::where('user_id', $user)->where('data_ligacao')->get();
        }
        return Ligacao::whereMonth('data_ligacao', date('Y-m-d'))->where('user_id', $user)->get();
    }
}
