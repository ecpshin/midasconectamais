<?php

namespace App\Http\Controllers;

use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Ligacao;
use App\Models\Operacao;
use App\Models\Organizacao;
use App\Models\Situacao;
use App\Models\Status;
use App\Models\Tabela;
use App\Services\LigacoesService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class LigacaoController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:list cliente', ['only' => ['index']]);
        $this->middleware('can:create cliente', ['only' => ['create', 'store']]);
        $this->middleware('can:edit cliente', ['only' => ['edit', 'update']]);
        $this->middleware('can:show cliente', ['only' => ['show']]);

        $this->service = new LigacoesService;
    }

    public function index()
    {
        $calls = [];

        if (auth()->user()->hasRole('super-admin')) {
            $calls = Ligacao::with(['situacao'])->whereNotNull('user_id')->limit(100)->get();
        } else {
            $calls = Ligacao::with(['situacao'])->where('user_id', auth()->user()->id)->get();
        }
        return view('calls.index', [
            'area' => 'Call Center',
            'page' => 'Lista de Ligações',
            'rota' => 'admin.calls.index',
            'calls' => $calls,
            'statuses' => Status::all()
        ]);
    }

    public function create()
    {
        return view('calls.create', [
            'area' => 'Call Center',
            'page' => 'Realizar Ligação',
            'rota' => 'admin.calls.index',
            'statuses' => Status::all()
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
            'statuses' => Status::all()
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
        $lista = Ligacao::whereNull('user_id')->where(function ($query) {
            return $query->where('orgao', 'LIKE', 'Prefeitura%')->orWhere('orgao', 'LIKE', 'pref%');
        })->lazy(1000);
        return view('calls.prefeituras', [
            'area' => 'Call Center',
            'page' => 'Lista de Prefeituras',
            'rota' => 'admin.calls.prefeituras',
            'listas' => $lista->random(100),
            'statuses' => Status::all()
        ]);
    }

    public function governos()
    {
        $lista = $this->service->getListaGoverno();
        return view('calls.governos', [
            'area' => 'Call Center',
            'page' => 'Lista de Governo',
            'rota' => 'admin.calls.governos',
            'listas' => $lista,
            'statuses' => Status::all()
        ]);
    }

    public function proposta(Ligacao $ligacao)
    {
        $correspondentes = Correspondente::all();
        $financeiras = Financeira::orderBy('nome_financeira', 'asc')->get();
        $operacoes = Operacao::orderBy('descricao_operacao', 'asc')->get();
        $situacoes = Situacao::all();
        $tabelas = Tabela::all();
        $orgaos = Organizacao::orderBy('nome_organizacao', 'asc')->get();

        return view('calls.proposta', [
            'cliente' => $ligacao,
            'area' => 'Call Center - Proposta',
            'page' => 'Proposta Cliente',
            'rota' => 'admin.calls.index',
            'correspondentes' => $correspondentes,
            'financeiras' => $financeiras,
            'operacoes' => $operacoes,
            'situacoes' => $situacoes,
            'tabelas' => $tabelas,
            'orgaos' => $orgaos
        ]);
    }

    public function getcliente(string $id)
    {
        $ligacao = Ligacao::find(intval($id))->toJson();
        echo $ligacao;
    }

    public function agendados(Request $request)
    {
        if ($request->input('data_agendamento')) {
            $agendados = Ligacao::where('user_id', auth()->user()->id)->whereDate('data_agendamento', $request->input('data_agendamento'))->get();
        } else {
            $agendados = null;
        }
        return view('calls.agendados', [
            'area' => 'Call Center - Agendados',
            'page' => 'Clientes Agendados',
            'rota' => 'admin.calls.agendados',
            'calls' => $agendados,
            'statuses' => Status::all()
        ]);
    }
}
