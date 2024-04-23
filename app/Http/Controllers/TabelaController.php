<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tabelas\StoreTabelaRequest;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Tabela;
use Illuminate\Http\Request;
use Number;


class TabelaController extends Controller
{

    public $fmt = null;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create tabela-comissao', ['only' => ['create', 'store']]);
        $this->middleware('can:list tabela-comissao', ['only' => ['index', 'show']]);
        $this->middleware('can:view tabela-comissao', ['only' => ['show']]);
        $this->middleware('can:edit tabela-comissao', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete tabela-comissao', ['only' => ['destroy']]);
        $this->fmt = new Number;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tabela_comissoes.index', [
            'area' => 'Restrita',
            'page' => 'Tabelas de Comissões Registradas',
            'rota' => 'admin',
            'tabelas' => Tabela::all(),
            'fmt' => $this->fmt
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tabela_comissoes.create', [
            'area' => 'Restrita',
            'page' => 'Registrar Comissão',
            'rota' => 'admin',
            'correspondentes' => Correspondente::all(['id', 'nome_correspondente']),
            'financeiras' => Financeira::all(['id', 'nome_financeira'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabelaRequest $request)
    {
        $attributes = $request->validated();
        Tabela::create($attributes);
        alert()->success('Sucesso', 'Tabela de comissão registrada com sucesso!');
        return redirect(route('admin.tabela.comissoes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tabela $tabela)
    {
        $fmt = new Number;

        return view('admin.tabela_comissoes.edit', [
            'area' => 'Restrita',
            'page' => 'Exibindo Tabela de Comissão',
            'rota' => 'admin.tabela.comissoes.index',
            'correspondentes' => Correspondente::all(['id', 'nome_correspondente']),
            'financeiras' => Financeira::all(['id', 'nome_financeira']),
            'fmt' => $this->fmt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabela $tabela)
    {
        return view('admin.tabela_comissoes.edit', [
            'area' => 'Restrita',
            'page' => 'Editar Tabela de Comissão',
            'rota' => 'admin.tabela.comissoes.index',
            'tabela' => $tabela,
            'correspondentes' => Correspondente::all(['id', 'nome_correspondente']),
            'financeiras' => Financeira::all(['id', 'nome_financeira']),
            'fmt' => $this->fmt
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabela $tabela)
    {
        $tabela->update($request->all());
        alert()->success('Sucesso', 'Tabela foi atualizada com sucesso');
        return redirect(route('admin.tabela.comissoes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabela $tabela)
    {
        //
    }

    public function get_tabela($id)
    {
        return Tabela::find($id)->toJson();
    }

    public function getfinanceiras($id)
    {
        return Tabela::select('id', 'nome_financeira')->where('financeira_id', $id)->get();
    }
}
