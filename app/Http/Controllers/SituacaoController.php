<?php

namespace App\Http\Controllers;

use App\Http\Requests\Situacoes\SituacoesStoreRequest;
use App\Models\Situacao;
use Illuminate\Http\Request;
use App\Helpers\FuncoesHelper;

class SituacaoController extends Controller
{
    public $situacoes;
    public $area;
    public $rota;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:delete situacao', ['only' => ['destroy']]);
        $this->middleware('can:edit situacao', ['only' => ['edit', 'update']]);
        $this->middleware('can:list situacao', ['only' => ['index']]);
        $this->middleware('can:update situacao', ['only' => ['update']]);
        $this->middleware('can:view situacao', ['only' => ['show']]);

        $this->situacoes = Situacao::all();
        $this->rota = 'admin.situacoes.index';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete('Excluir', 'Deseja excluir esta situação?');
        return view('situacoes.index', [
            'situacoes' => $this->situacoes,
            'area' => $this->getstring('situações'),
            'page' => $this->getstring('cadastradas', 'situações'),
            'rota' => $this->rota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('situacoes.create', [
            'situacoes' => $this->situacoes,
            'area' => $this->getstring('situações'),
            'page' => $this->getstring('situação', 'cadastrar'),
            'rota' => $this->rota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SituacoesStoreRequest $request)
    {
        $attributes = $request->validated();
        $situacao = Situacao::create($attributes);
        if ($situacao instanceof Situacao) {
            return redirect()->route('admin.situacoes.index')->with('success', 'Cadastro realizado com sucesso.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Situacao $situacao)
    {
        return view('situacoes.show', [
            'situacao' => $situacao,
            'area' => $this->getstring(),
            'page' => $this->getstring('situação', 'exibir dado(s)'),
            'rota' => $this->rota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Situacao $situacao)
    {
        return view('situacoes.edit', [
            'situacao' => $situacao,
            'area' => $this->getstring(),
            'page' => $this->getstring('situação', 'atualizar dado(s)'),
            'rota' => $this->rota,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Situacao $situacao)
    {
        $situacao->update($request->all());
        alert()->success('Sucesso', 'Atualização realizada com sucesso.');
        return redirect()->route('admin.situacoes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Situacao $situacao)
    {
        $situacao->delete();
        return redirect()->route('admin.situacoes.index')->with('warning', 'Exclusão realizada com sucesso');
    }

    public function getstring($area = 'situações', $page = null): string
    {
        return (!is_null($page)) ? ucfirst($page) . ' ' . ucfirst($area) : ucfirst($area);
    }
}
