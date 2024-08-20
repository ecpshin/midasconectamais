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

    public function getListaAgendados($user = null, $data = null): Collection
    {
        return (!is_null($data)) ?  Ligacao::where(function ($query) use ($user, $data) {
                $query->where('user_id', $user)->where('data_agendamento', $data);
            })->get() : Ligacao::where('user_id', $user)->whereNotNull('data_agendamento')->get();
    }

    public function ligacoesAgente($inicio = null, $fim = null, $user = null): Collection
    {
        return Ligacao::where('user_id', $user)
            ->where(function ($query) use ($inicio, $fim) {
                $query->whereDate('data_ligacao', '>=', $inicio)
                    ->whereDate('data_ligacao', '<=', $fim);
            })->get();
    }
    public function all($id = null): Collection
    {
        return (is_null($id)) ?
            Ligacao::whereNotNull('user_id')->get():
            Ligacao::where(function($query) use ($id) {
                $query->whereUserId($id);
            })->get();
    }
}
