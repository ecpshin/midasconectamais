<?php

namespace App\Http\Controllers;

use App\Models\Ligacao;
use App\Models\Status;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calls = [];

        if (auth()->user()->hasRole('super-admin')) {
            $calls = Ligacao::whereNotNull('user_id')->get();
        } else {
            $calls = Ligacao::where('user_id', auth()->user()->id)->orWhereNull('user_id')->get();
        }
        return view('calls.index', [
            'area' => 'Call Center',
            'page' => 'Lista de Ligações',
            'rota' => 'admin.calls.index',
            'calls' => $calls->random(100),
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calls.create', [
            'area' => 'Call Center',
            'page' => 'Realizar Ligação',
            'rota' => 'admin.calls.index',
            'statuses' => Status::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        auth()->user()->calls()->create($request->all());
        Alert::success('Ok', 'Ligação realizada por ' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ligacao $ligacao)
    {
        return view('calls.edit', [
            'call' => $ligacao,
            'area' => 'Call Center',
            'page' => 'Exibir Ligação',
            'rota' => 'admin.calls.index',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ligacao $ligacao)
    {
        $uuid = (string) Str::uuid4();
        dd($uuid['uuid']);
        $ligacao->update($request->all());
        Alert::success('Ok', 'Atualização realizada por' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ligacao $ligacao)
    {
        $ligacao->forceDelete();
        Alert::success('Ok', 'Atualização realizada por' . auth()->user()->name);
        return redirect()->route('admin.calls.index');
    }

    public function prefeituras()
    {
        $lista = Ligacao::where('orgao', 'LIKE', 'Prefeitura%')->lazy(1000);
        return view('calls.prefeituras', [
            'area' => 'Call Center',
            'page' => 'Lista de Prefeituras',
            'rota' => 'admin.calls.prefeituras',
            'listas' => $lista,
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

    public function proposta()
    {
        $calls = [];

        if (auth()->user()->hasRole('super-admin')) {
            $calls = Ligacao::limit('10')->get();
        } else {
            $calls = Ligacao::where('user_id', auth()->user()->id)->get();
        }
        return view('calls.index', [
            'area' => 'Call Center - Propostas',
            'page' => 'Lista de Ligações',
            'rota' => 'admin.calls.index',
            'calls' => $calls,
            'statuses' => Status::all()
        ]);
    }

    public function getcliente(string $id)
    {
        $ligacao = Ligacao::find(intval($id))->toJson();
        echo $ligacao;
    }

    public function agendados(Request $request)
    {
        dd($request->all());
        if ($request->input('data_agendamento')) {
            $agendados = Ligacao::where('user_id', auth()->user()->id)->whereDate('data_agendamento', $request->input('data_agendamento'))->get();
        } else {
            $agendados = [];
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
