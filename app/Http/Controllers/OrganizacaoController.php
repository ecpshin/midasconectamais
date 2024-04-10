<?php

namespace App\Http\Controllers;

use App\Models\Organizacao;
use App\Http\Requests\Organizacoes\OrganizacoesStoreRequest;

class OrganizacaoController extends Controller
{
    public $orgaos;
    public $area;
    public $rota;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create organizacao', ['only' => ['create']]);
        $this->middleware('can:edit organizacao', ['only' => ['edit', 'update']]);
        $this->middleware('can:update organizacao', ['only' => ['update']]);
        $this->middleware('can:list organizacao', ['only' => ['index']]);
        $this->middleware('can:view organizacao', ['only' => ['show']]);
        $this->orgaos = Organizacao::paginate(5);
        $this->area = 'Organizações (Órgãos)';
        $this->rota = 'admin.organizacoes.index';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('organizacoes.index', [
            'area' => $this->area,
            'page' => 'Organizações Cadastradas',
            'rota' => $this->rota,
            'orgaos' => $this->orgaos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizacoes.create', [
            'area' => $this->area,
            'page' => 'Cadastrar Órgão',
            'rota' => $this->rota
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizacoesStoreRequest $request)
    {
        $attributes = $request->validated();
        $org = Organizacao::create($attributes);
        if ($org instanceof Organizacao) {
            alert()->success('Sucesso', 'Órgão cadastrado com sucesso!');
            return redirect()->route('admin.organizacoes.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizacao $organizacao)
    {
        return view('organizacoes.show', [
            'orgao' => $organizacao,
            'area' => 'Organizações (Órgãos)',
            'page' => 'Exibir Organização',
            'rota' => $this->rota
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizacao $organizacao)
    {
        //
        return view('organizacoes.edit', [
            'orgao' => $organizacao,
            'area' => 'Organizações (Órgãos)',
            'page' => 'Atualizar Organização',
            'rota' => $this->rota
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizacoesStoreRequest $request, Organizacao $organizacao)
    {
        $attributes = $request->validated();
        $org = $organizacao->update($attributes);

        if ($org != 0) {
            alert()->success('Sucesso', 'Órgão atualizado com sucesso!');
            return redirect()->route('admin.organizacoes.index');
        }

        return redirect()->back()->with('message', 'Não foi possível realizar a atualizaçãp');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizacao $organizacao)
    {
        $organizacao->delete();
        alert()->error('Atencão', 'Você excluiu uma organização!');
        return redirect()->route('admin.organizacoes.index');
    }
}
