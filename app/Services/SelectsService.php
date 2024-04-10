<?php

namespace App\Services;

use App\Models\Operacao;
use App\Models\User;

class SelectsService
{

    public function __construct()
    {
    }

    public function selectAgentes($id = null)
    {
        return (is_null($id)) ? User::all() : User::find($id);
    }

    public function selectOperacoes($id = null)
    {
        $columns = ['id', 'descricao_operacao'];
        return (is_null($id)) ? Operacao::all($columns) : Operacao::where('id', $id)->get($columns);
    }
}
