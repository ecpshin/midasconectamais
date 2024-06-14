<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clientes\ClienteStoreRequest;
use App\Models\Cliente;
use NumberFormatter;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Ramsey\Uuid\Uuid;
use App\Services\GeneralService;

class ClienteController extends Controller
{
    public $svc = null;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:create cliente', ['only' => ['create', 'proposta', 'special', 'store']]);
        $this->middleware('can:edit cliente', ['only' => ['edit', 'update']]);
        $this->middleware('can:list cliente', ['only' => ['index']]);
        $this->middleware('can:view cliente', ['only' => ['show', 'index']]);
        $this->middleware('can:update cliente', ['only' => ['update']]);

        $this->svc = new GeneralService;
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
        return view('admin.clientes.create', [
            'area' => 'Clientes',
            'page' => 'Clientes Cadastrados',
            'rota' => 'admin.clientes.index',
            'correspondentes' => $this->svc->correspondentes(),
            'financeiras' => $this->svc->financeiras(),
            'orgaos' => $this->svc->organizacoes(),
            'produtos' => $this->svc->produtos(),
            'situacoes' => $this->svc->situacoes(['id', 'descricao_situacao']),
            'tabelas' => $this->svc->tabelas()
        ]);
    }

    public function proposta()
    {
        $auxs = $this->svc->agentes();

        $agentes = $auxs->filter(function ($aux) {
            return $aux->tipo == 'agente';
        });

        $corretores = $auxs->filter(function ($aux) {
            return $aux->tipo == 'corretores';
        });

        return view('admin.clientes.proposta', [
            'area' => 'Clientes',
            'page' => 'Proposta Cliente',
            'rota' => 'admin.clientes.index',
            'correspondentes' => $this->svc->correspondentes(),
            'financeiras' => $this->svc->financeiras(),
            'orgaos' => $this->svc->organizacoes(),
            'produtos' => $this->svc->produtos(),
            'situacoes' => $this->svc->situacoes(['id', 'descricao_situacao']),
            'tabelas' => $this->svc->tabelas(),
            'agentes' => $agentes,
            'corretores' => $corretores,
            'uuid' => substr((string) Uuid::uuid4(), 0, 13)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request)
    {
        $attributes = $request->validated();
        $request['user_id'] = $request->user()->id;

        $cliente = $request->user()->clientes()->create($attributes);
        $cliente->vinculos()->create($request->all());
        $cliente->infoBancarias()->create($request->all());
        $cliente->infoResidencial()->create($request->all());

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $path = 'arquivos/clientes/' . str_ireplace('.', '', str_ireplace('-', '', $request->cpf)) . '/';

            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $savedPathName = $file->storeAs($path . $fileName);
                $cliente->arquivosCliente()->create([
                    'name' => $fileName,
                    'path' => $savedPathName
                ]);
            }
        }

        Alert::success('Sucesso', 'Cadastro Realizado com sucesso');
        return redirect()->route('admin.clientes.index');
    }

    public function special(ClienteStoreRequest $request)
    {

        $request['user_id'] = $request->user()->id;

        $attributes = $request->validated();
        $cliente = $request->user()->clientes()->create($attributes);
        $proposta = $cliente->propostas()->create($request->all());
        $proposta->comissao()->create($request->all());
        $cliente->vinculos()->create($request->all());
        $cliente->infoBancarias()->create($request->all());
        $cliente->infoResidencial()->create($request->all());

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $path = 'arquivos/clientes/' . str_ireplace('.', '', str_ireplace('-', '', $request->cpf)) . '/';

            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $savedPathName = $file->storeAs($path . $fileName);
                $cliente->arquivosCliente()->create([
                    'name' => $fileName,
                    'path' => $savedPathName
                ]);
            }
        }


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
