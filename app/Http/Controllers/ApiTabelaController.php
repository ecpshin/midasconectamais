<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comissoes\TabelasResource;
use App\Http\Resources\Organizacoes\OrganizacoesResource;
use App\Models\Organizacao;
use App\Models\Tabela;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;

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
        $tabelas = Tabela::where('organizacao_id', $id)->get();

        return TabelasResource::collection($tabelas);
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
}
