<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clientes\ClienteStoreRequest;
use App\Models\Cliente;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\InfoBancaria;
use App\Models\InfoResidencial;
use App\Models\Operacao;
use App\Models\Organizacao;
use App\Models\Produto;
use App\Models\Situacao;
use App\Models\Tabela;
use App\Models\Vinculo;
use NumberFormatter;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:create cliente', ['only' => ['create', 'store']]);
        $this->middleware('can:edit cliente', ['only' => ['edit', 'update']]);
        $this->middleware('can:list cliente', ['only' => ['index']]);
        $this->middleware('can:view cliente', ['only' => ['show', 'index']]);
        $this->middleware('can:update cliente', ['only' => ['update']]);
    }

    public function index()
    {
        if (auth()->user()->hasRole('super-admin')) {
            $clientes = Cliente::all();
        } else {
            $clientes = Cliente::where('user_id', auth()->user()->id)->get();
        }
        return view('admin.clientes.index', [
            'clientes' => $clientes,
            'area' => 'Clientes',
            'page' => 'Clientes Cadastrados',
            'rota' => 'admin.clientes.index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $correspondentes = Correspondente::all();
        $financeiras = Financeira::all();
        $produtos = Produto::all();
        $situacoes = Situacao::all();
        $tabelas = Tabela::all();

        return view('admin.clientes.create', [
            'area' => 'Clientes',
            'page' => 'Clientes Cadastrados',
            'rota' => 'admin.clientes.index',
            'correspondentes' => $correspondentes,
            'financeiras' => $financeiras,
            'orgaos' => Organizacao::all(),
            'operacoes' => $produtos,
            'situacoes' => $situacoes,
            'tabelas' => $tabelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request)
    {
        $request['user_id'] = $request->user()->id;

        $attributes = $request->validated();
        $cliente = $request->user()->clientes()->create($attributes);
        $proposta = $cliente->propostas()->create($request->all());
        $proposta->comissao()->create($request->all(['proposta_id', 'tabela_id', 'percentual_loja', 'valor_loja', 'percentual_operador', 'valor_operador']));
        $cliente->vinculos()->create($request->all());
        $cliente->infoBancarias()->create($request->all());
        $cliente->infoResidencial()->create($request->all());
        Alert::success('Yeahh', 'Cadastro Realizado com sucesso');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $fmt = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
        return view('admin.clientes.show', [
            'cliente' => $cliente,
            'area' => 'Clientes',
            'page' => 'Perfil do Cliente',
            'rota' => 'admin.clientes.index',
            'fmt' => $fmt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', [
            'cliente' => $cliente,
            'area' => 'Clientes',
            'page' => 'Editar Dados do Cliente',
            'rota' => 'admin.clientes.index',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $attributes = $request->all();
        $cliente->update($attributes);
        alert()->success('Sucesso', 'Atualização realizada com sucesso!');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->forceDelete();
        alert()->warning('Atenção', 'Você acabou de excluir um cliente e todas as suas dependências.');
        return redirect()->route('admin.clientes.index');
    }
}
