<?php

namespace App\Http\Controllers;

use App\Http\Requests\Operacoes\OperacoesStoreRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OperacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operacoes = Operacao::paginate(5);
        return view('operacoes.index', [
            'operacoes' => $operacoes,
            'area' => 'Operações',
            'page' => 'Operações Cadastradas',
            'rota' => 'admin.operacoes.index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operacoes.create', [
            'area' => 'Operações',
            'page' => 'Cadastro e Operação',
            'rota' => 'admin.operacoes.index',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OperacoesStoreRequest $request)
    {
        $attributes = $request->validated();
        $operacao = Operacao::create($attributes);
        if ($operacao instanceof Operacao) {
            Alert::success('Sucesso', 'Descrição da operação cadastrada com sucesso!');
            return redirect()->route('admin.operacoes.index');
        } else {
            return redirect()->back()->with('msg', 'Opa');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Operacao $operacao)
    {
        //
        return view('operacoes.show', [
            'area' => 'Operações',
            'page' => 'Exibindo Operação',
            'rota' => 'admin.operacoes.index',
            'operacao' => $operacao,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operacao $operacao)
    {
        return view('operacoes.edit', [
            'operacao' => $operacao,
            'area' => 'Operações',
            'page' => 'Atualizar Operação',
            'rota' => 'admin.operacoes.index',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OperacoesStoreRequest $request, Operacao $operacao)
    {
        $attributes = $request->validated();

        if ($operacao->update($attributes)) {
            Alert::success('Sucesso', 'Descrição da operação foi atualizada com sucesso!');
            return redirect()->route('admin.operacoes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operacao $operacao)
    {
        if ($operacao->delete()) {
            Alert::error('Sucesso', 'Descrição da operação foi atualizada com sucesso!');
            return redirect()->route('admin.operacoes.index');
        } else {
            return redirect()->back()->with('error', 'Falhou a tentativa de exclusão!');
        }
    }

    public function search()
    {
    }
}
