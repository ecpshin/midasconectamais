<?php

namespace App\Http\Controllers;

use App\Models\Organizacao;
use App\Models\Vinculo;
use Illuminate\Http\Request;

class VinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vinculo $vinculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vinculo $vinculo)
    {
        $orgaos = Organizacao::all();
        return view('admin.clientes.dados-funcionais.edit', [
            'dados' => $vinculo,
            'orgaos' => $orgaos,
            'area' => 'Clientes',
            'page' => 'Editar Dados Funcionais',
            'rota' => 'admin.clientes.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vinculo $vinculo)
    {
        $vinculo->update($request->all());
        alert()->success('Sucesso', 'Atualização realizada com sucesso.');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vinculo $vinculo)
    {
        //
    }
}
