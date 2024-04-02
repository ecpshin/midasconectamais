<?php

namespace App\Http\Controllers;

use App\Models\Ligacao;
use App\Models\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LigacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:list cliente', ['only' => ['index']]);
        $this->middleware('can:create cliente', ['only' => ['create', 'store']]);
        $this->middleware('can:edit cliente', ['only' => ['edit', 'update']]);
        $this->middleware('can:show cliente', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calls = [];

        if (auth()->user()->hasRole('super-admin')) {
            $calls = Ligacao::all();
        } else {
            $calls = Ligacao::where('user_id', auth()->user()->id)->get();
        }
        return view('calls.index', [
            'area' => 'Call Center',
            'page' => 'Lista de Ligações',
            'rota' => 'admin.calls.index',
            'calls' => $calls,
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

    public function agendados()
    {
        //
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
}
