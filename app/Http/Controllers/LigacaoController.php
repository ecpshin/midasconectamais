<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filtros\FiltraLigacoesRequest;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Ligacao;
use App\Models\Operacao;
use App\Models\Organizacao;
use App\Models\Produto;
use App\Models\Situacao;
use App\Models\Status;
use App\Models\Tabela;
use App\Models\User;
use App\Services\GeneralService;
use App\Services\LigacoesService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class LigacaoController extends Controller
{
    public $service;
    public $geral;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:list cliente', ['only' => ['index']]);
        $this->middleware('can:create cliente', ['only' => ['create', 'store']]);
        $this->middleware('can:edit cliente', ['only' => ['edit', 'update']]);
        $this->middleware('can:show cliente', ['only' => ['show']]);

        $this->service = new LigacoesService;
        $this->geral = new GeneralService;

    }

    public function index()
    {
        $calls = [];

        if (auth()->user()->hasRole('super-admin')) {
            $calls = $this->service->all();
        } else {
            $calls = $this->service->all(auth()->user()->id);
        }

        return view('calls.index', [
            'area' => 'Call Center',
            'page' => 'Lista de Ligações',
            'rota' => 'admin.calls.index',
            'calls' => $calls,
            "users" => User::all(),
            'statuses' => Status::all(),
            'produtos' => Produto::all(['id', 'descricao_produto']),
            'orgaos' => Organizacao::all(['id', 'nome_organizacao'])
        ]);
    }

    public function create()
    {
        return view('calls.create', [
            'area' => 'Call Center',
            'page' => 'Realizar Ligação',
            'rota' => 'admin.calls.index',
            'statuses' => Status::all(),
            'orgaos' => Organizacao::all(['id', 'nome_organizacao'])
        ]);
    }

    public function store(Request $request)
    {
        auth()->user()->calls()->create($request->all());
        Alert::success('Ok', 'Ligação realizada por ' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    public function show(Ligacao $ligacao)
    {
        return view('calls.edit', [
            'call' => $ligacao,
            'area' => 'Call Center',
            'page' => 'Exibir Ligação',
            'rota' => 'admin.calls.index',
        ]);
    }

    public function edit(Ligacao $ligacao)
    {

        return view('calls.edit', [
            'call' => $ligacao,
            'area' => 'Call Center',
            'page' => 'Editar Ligação',
            'rota' => 'admin.calls.index',
            'statuses' => $this->geral->statuses(),
            'orgaos' => $this->geral->organizacoes(['id', 'nome_organizacao']),
            'produtos' => $this->geral->produtos()
        ]);
    }

    public function update(Request $request, Ligacao $ligacao)
    {
        $ligacao->update($request->all());
        Alert::success('Ok', 'Atualização realizada por' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    public function destroy(Ligacao $ligacao)
    {
        $ligacao->forceDelete();
        Alert::success('Ok', 'Atualização realizada por' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    public function prefeituras()
    {
        $lista = $this->service->getListaPrefeitura();
        return view('calls.prefeituras', [
            'area' => 'Call Center',
            'page' => 'Lista de Prefeituras',
            'rota' => 'admin.calls.prefeituras',
            'listas' => $lista->random(100),
            'statuses' => Status::all(),
            'produtos' => $this->geral->produtos(),
            'orgaos' => $this->geral->organizacoes(['id', 'nome_organizacao'])
        ]);
    }

    public function governos()
    {
        $lista = $this->service->getListaGoverno();
        $orgaos = $this->geral->organizacoes();
        $produtos = $this->geral->produtos();
        $statuses = $this->geral->statuses();
        return view('calls.governos', [
            'area' => 'Call Center',
            'page' => 'Lista de Governo',
            'rota' => 'admin.calls.governos',
            'listas' => $lista,
            'orgaos' => $orgaos,
            'produtos' => $produtos,
            'statuses' => $statuses
        ]);
    }

    public function proposta(Ligacao $ligacao)
    {
        $correspondentes = Correspondente::all();
        $financeiras = Financeira::orderBy('nome_financeira', 'asc')->get();
        $produtos = Produto::orderBy('descricao_produto', 'asc')->get();
        $situacoes = Situacao::all();
        $tabelas = Tabela::all();
        $orgaos = Organizacao::select('id', 'nome_organizacao')->orderBy('nome_organizacao', 'asc')->get();
        $cliente = Ligacao::with('organizacao')->findOrFail($ligacao->id);

        return view('calls.proposta', [
            'cliente' => $cliente,
            'area' => 'Call Center - Proposta',
            'page' => 'Proposta Cliente',
            'rota' => 'admin.calls.index',
            'correspondentes' => $correspondentes,
            'financeiras' => $financeiras,
            'produtos' => $produtos,
            'situacoes' => $situacoes,
            'tabelas' => $tabelas,
            'orgaos' => $orgaos,
            'uuid' => substr(Str::uuid(), 0, 18)
        ]);
    }

    public function getcliente(string $id)
    {
        $ligacao = Ligacao::find(intval($id))->toJson();
        echo $ligacao;
    }

    public function agendados(Request $request)
    {
        $agendados = [];
        if ($request->input('data_agendamento')) {
            $agendados = $this->service->getListaAgendados(
                auth()->user()->id,
                $request->input('data_agendamento')
            );
        }

        return view('calls.agendados', [
            'area' => 'Call Center - Agendados',
            'page' => 'Clientes Agendados',
            'rota' => 'admin.calls.agendados',
            'calls' => $agendados,
            'statuses' => Status::all()
        ]);
    }

    public function gerenciar()
    {
        $calls = null;
        $users = User::whereNotIn('id', [1, 2, 9])->get();

        return view('calls.filtrar', [
            'area' => 'Call Center',
            'page' => 'Gerenciar Call Center',
            'rota' => 'admin.calls.gerenciar',
            'calls' => $calls,
            'statuses' => Status::all(),
            'users' => $users
        ]);
    }
    public function filtrar(FiltraLigacoesRequest $request)
    {
        $attributes = $request->validated();
        $calls = [];
        $users = User::whereNotIn('id', [1, 2, 9])->get();
        if (!is_null($request->input('inicio'))) {
            $calls = $this->service->ligacoesAgente($attributes['inicio'], $attributes['final'], $attributes['user_id']);

            return view('calls.filtrar', [
                'area' => 'Call Center',
                'page' => 'Gerenciar Call Center',
                'rota' => 'admin.calls.gerenciar',
                'calls' => $calls,
                'statuses' => Status::all(),
                'users' => $users
            ]);
        }
        Alert()::error('Ooops', 'Verifique os dados');
        return redirect()->back();
    }
}
