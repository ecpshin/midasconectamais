<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produtos\StoreProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all(['id', 'descricao_produto']);
        return view('produtos.index', [
            'produtos' => $produtos,
            'area' => 'Produtos',
            'page' => 'Produtos Cadastrados',
            'rota' => 'admin.produtos.index'
        ]);
    }

    public function create()
    {
        return view('produtos.create', [
            'area' => 'Produtos',
            'page' => 'Cadastrar Produto',
            'rota' => 'admin.produtos.index',
        ]);
    }

    public function store(StoreProdutoRequest $request)
    {
        $attributes = $request->validated();
        $produto = Produto::create($attributes);
        if ($produto instanceof Produto) {
            Alert::success('Sucesso', 'Produto cadastrado com sucesso!');
            return redirect()->route('admin.produtos.index');
        } else {
            return redirect()->back()->with('msg', 'Opa');
        }
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', [
            'area' => 'Produtos',
            'page' => 'Exibindo Produto',
            'rota' => 'admin.produtos.index',
            'produto' => $produto,
        ]);
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', [
            'produto' => $produto,
            'area' => 'Produtos',
            'page' => 'Atualizar Produto',
            'rota' => 'admin.produtos.index',
        ]);
    }

    public function update(StoreProdutoRequest $request, Produto $produto)
    {
        $attributes = $request->validated();

        if ($produto->update($attributes)) {
            Alert::success('Sucesso', 'Produto atualizado com sucesso!');
            return redirect()->route('admin.produtos.index');
        }
    }

    public function destroy(Produto $produto)
    {
        if ($produto->delete()) {
            Alert::error('Sucesso', 'Produto foi excluído com sucesso!');
            return redirect()->route('admin.produtos.index');
        } else {
            return redirect()->back()->with('error', 'Falhou a tentativa de exclusão!');
        }
    }
}
