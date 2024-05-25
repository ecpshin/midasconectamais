<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Organizacao;
use App\Models\Produto;
use App\Models\Proposta;
use App\Models\Situacao;
use App\Models\Status;
use App\Models\Tabela;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GeneralService
{
    public function clientes($columns = null): Collection
    {
        return is_null($columns) ? Cliente::all() : Cliente::all($columns);
    }

    public  function correspondentes($colums = null): Collection
    {
        return is_null($colums) ? Correspondente::all() : Correspondente::all($colums);
    }

    public  function financeiras($columns = null): Collection
    {
        return is_null($columns) ?  Financeira::all() : Financeira::all($columns);
    }

    public  function organizacoes($columns = null): Collection
    {
        return  is_null($columns) ? Organizacao::all() : Organizacao::all($columns);
    }

    public  function produtos($columns = null): Collection
    {
        return (is_null($columns)) ? Produto::all() : Produto::all($columns);
    }

    public  function propostas($columns = null): Collection
    {
        return Proposta::orderBy('data_digitacao', 'desc')->get();
    }

    public  function situacoes($columns = null): Collection
    {
        return is_null($columns) ? Situacao::all() : Situacao::all($columns);
    }

    public  function statuses($columns = null): Collection
    {
        return is_null($columns) ? Status::all() : Status::all($columns);
    }

    public  function tabelas($columns = null): Collection
    {
        return is_null($columns) ? Tabela::all() : Tabela::all($columns);
    }

    public  function agentes($columns = null): Collection
    {
        return is_null($columns) ? User::orderBy('name', 'asc')->get() : User::whereNotIn('id', [1, 2])->orderBy('name', 'asc')->orderBy('name', 'asc')->get($columns);
    }
}
