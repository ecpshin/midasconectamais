<?php

namespace App\Http\Controllers;

use App\Models\InfoBancaria;
use Illuminate\Http\Request;

class InfoBancariaController extends Controller
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
    public function show(InfoBancaria $infoBancaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoBancaria $infoBancaria)
    {
        return view('admin.clientes.dados-bancarios.edit', [
            'dados' => $infoBancaria,
            'area' => 'Clientes',
            'page' => 'Editar Dados Bancários',
            'rota' => 'admin.clientes.index'
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoBancaria $infoBancaria)
    {
        $infoBancaria->update($request->all());
        alert()->success('Atualização realizada com sucesso!');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoBancaria $infoBancaria)
    {
        //
    }
}
