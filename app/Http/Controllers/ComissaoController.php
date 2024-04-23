<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Comissao;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Produto;
use App\Models\Proposta;
use App\Models\Situacao;
use App\Models\Tabela;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class ComissaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create comissao', ['only' => ['create', 'store']]);
        $this->middleware('can:delete comissao', ['only' => ['delete']]);
        $this->middleware('can:edit comissao', ['only' => ['edit', 'update']]);
        $this->middleware('can:list comissao', ['only' => ['index']]);
        $this->middleware('can:view comissao', ['only' => ['show']]);
    }

    public function index(Request $request)
    {

        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');

        $propostas = Proposta::with(['cliente', 'comissao', 'correspondente', 'financeira', 'produto', 'situacao', 'user'])
            ->whereMonth('data_digitacao', $mesAtual)
            ->get();
        $all = $propostas->map(function ($proposta) {
            return $proposta->comissao;
        });

        $fmt = new Number;

        return view('admin.comissoes.index', [
            'area' => $this->getarea(),
            'page' => $this->getpage('Cadastradas'),
            'rota' => $this->getrota(),
            'propostas' => $propostas,
            'loja' => $this->toMoeda($all->sum('valor_loja') ?? 0),
            'agente' => $this->toMoeda($all->sum('valor_operador') ?? 0),
            'total' => $this->toMoeda($propostas->sum('total_proposta') ?? 0),
            'liquido' => $this->toMoeda($propostas->sum('liquido_proposta') ?? 0),
            'fmt' => $fmt,
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Comissao $comissao)
    {
        return view('admin.comissoes.edit', [
            'area' => $this->getarea(),
            'page' => $this->getpage('Cadastradas'),
            'rota' => $this->getrota(),
            'correspondentes' => Correspondente::all(),
            'financeiras' => Financeira::all(),
            'comissao' => $comissao,
            'produtos' => Produto::all(),
            'situacoes' => Situacao::all(),
            'tabelas' => Tabela::with(['correspondente', 'financeira', 'produto'])->get()
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function porAgente(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $agente = $request->input('user_id') ? $request->input('user_id')  : null;

        $propostas = Proposta::with(['cliente', 'comissao', 'correspondente', 'financeira', 'operacao', 'situacao', 'user'])
            ->whereMonth('data_digitacao', $mesAtual)
            ->whereNot('user_id', 1)
            ->get();

        if (!is_null($agente)) {
            $propostas = Proposta::with(['cliente', 'comissao', 'correspondente', 'financeira', 'operacao', 'situacao', 'user'])
                ->whereMonth('data_digitacao', $mesAtual)
                ->where('user_id', $agente)
                ->get();
        }

        $all = $propostas->map(function ($proposta) {
            return $proposta->comissao;
        });

        $fmt = new Number;

        return view('admin.comissoes.filtrar', [
            'area' => $this->getarea(),
            'page' => $this->getpage('ajustar'),
            'rota' => $this->getrota(),
            'propostas' => $propostas,
            'total_loja' => $this->toMoeda($all->sum('valor_loja') ?? 0),
            'total_agente' => $this->toMoeda($all->sum('valor_operador') ?? 0),
            'total_propostas' => $this->toMoeda($propostas->sum('total_proposta') ?? 0),
            'total_liquido' => $this->toMoeda($propostas->sum('liquido_proposta') ?? 0),
            'fmt' => $fmt,
            'months' => $this->getMonths(),
            'agentes' => $this->getAgentes(),
            'mesAtual' => $mesAtual
        ]);
    }

    public function getpage($slug = null): string
    {
        return $this->getarea() . ' ' . ucfirst($slug);
    }

    public function getarea(): string
    {
        return 'Comissões';
    }

    public function getrota(): string
    {
        return 'admin.comissoes.index';
    }

    public function getAgentes(): Collection
    {
        return User::select(['id', 'name'])->with('roles')->get();
    }

    private function getMonths()
    {
        return [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];
    }

    public function toMoeda($valor = 0.0, $currency = 'BRL', $locale = 'pt_BR'): string
    {
        return Number::currency($valor, $currency, $locale);
    }
}
