<?php

namespace App\Http\Controllers;

use App\Http\Requests\Correspondentes\CorrespondenteStoreRequest;
use App\Models\Correspondente;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CorrespondenteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:create correspondente', ['only' => ['create']]);
        $this->middleware('can:edit correspondente', ['only' => ['edit', 'update']]);
        $this->middleware('can:list correspondente', ['only' => ['index']]);
        $this->middleware('can:view correspondente', ['only' => ['show']]);
        $this->middleware('can:delete correspondente', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $correspondentes = Correspondente::paginate(5);
        return view('correspondentes.index', [
            'area' => 'Correspondentes',
            'page' => 'Correspondentes Cadastrados',
            'rota' => 'admin.correspondentes.index',
            'correspondentes' => $correspondentes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('correspondentes.create', [
            'area' => 'Correspondentes',
            'page' => 'Cadastro de Correspondente',
            'rota' => 'admin.correspondentes.index',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CorrespondenteStoreRequest $request)
    {
        $attributes = $request->validated();
        $correspondente = Correspondente::create($attributes);
        if ($correspondente instanceof Correspondente) {
            alert()->success('Sucesso', 'Correspondente cadastrado com susesso.');
            return redirect()->route('admin.correspondentes.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Correspondente $correspondente)
    {
        return view('correspondentes.edit', [
            'area' => 'Correspondentes',
            'page' => 'Exibir Dados de Correspondente',
            'rota' => 'admin.correspondentes.index',
            'correspondente' => $correspondente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Correspondente $correspondente)
    {
        return view('correspondentes.edit', [
            'area' => 'Correspondentes',
            'page' => 'Editar Dados de Correspondente',
            'rota' => 'admin.correspondentes.index',
            'correspondente' => $correspondente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Correspondente $correspondente)
    {
        $correspondente->update($request->all());
        Alert::success('Sucesso', 'Atualização realizada com sucesso.');
        return redirect()->route('admin.correspondentes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Correspondente $correspondente)
    {
        $correspondente->delete();
        Alert::warning('Ops! Você excluiu correspondente com sucesso.');
        return redirect()->route('admin.correspondentes.index');
    }
}
