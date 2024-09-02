<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comissoes\TabelasResource;
use App\Http\Resources\Organizacoes\OrganizacoesResource;
use App\Models\Organizacao;
use App\Models\Tabela;

class ApiTabelaController extends Controller
{
    public function index()
    {
        //$tabelas = Tabela::all();
        $tabela = Tabela::query()->first();
        $resource = TabelasResource::make($tabela);

        return $resource;
    }

    public function tabela(string $id)
    {
        $tabelas = Tabela::find($id);
        return TabelasResource::make($tabelas);
    }

    public function tabelas(string $id)
    {
        $tables = Tabela::where('organizacao_id', $id)->get();

        $aux = [];

        foreach (($tables->groupBy('produto')) as $value) {
            array_push($aux, $value->first());
        }

        return TabelasResource::collection($aux);
    }

    public function organizacao(string $id)
    {
        $organizacao = Organizacao::findOrFail($id);

        return OrganizacoesResource::make($organizacao);
    }

    public function organizacoes()
    {
        $organizacoes = Organizacao::all();

        return OrganizacoesResource::collection($organizacoes);
    }

    public function financeira(string $orgao, string $produto)
    {
        $tables = Tabela::where('organizacao_id', $orgao)->where('produto_id', $produto)->get();

        $aux = [];

        foreach (($tables->groupBy('financeira')) as $value) {
            array_push($aux, $value->first());
        }

        return TabelasResource::collection($aux);
    }

    public function correspondentes(string $orgao, string $produto, string $financeira)
    {
        $tables = Tabela::where(function ($query) use ($orgao, $produto, $financeira) {
            $query->where('organizacao_id', $orgao)
                ->where('produto_id', $produto)
                ->where('financeira_id', $financeira);
        })->get();

        $aux = [];

        foreach (($tables->groupBy('correspondente')) as $value) {
            array_push($aux, $value->first());
        }

        return TabelasResource::collection($aux);
    }

    public function tabelas_comissao(string $orgao, string $produto, string $financeira, string $correspondente)
    {
        $tables = Tabela::where(function ($query) use ($orgao, $produto, $financeira, $correspondente) {
            $query->where('organizacao_id', $orgao)
                ->where('produto_id', $produto)
                ->where('financeira_id', $financeira)
                ->where('correspondente_id', $correspondente);
        })->get();

        return TabelasResource::collection($tables);
    }
}
