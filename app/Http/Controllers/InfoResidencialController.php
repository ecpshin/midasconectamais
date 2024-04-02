<?php

namespace App\Http\Controllers;

use App\Models\InfoResidencial;
use Illuminate\Http\Request;

class InfoResidencialController extends Controller
{
     public function index()
    {
        //
    }

    public function create()
    {
        //
    }

   public function store(Request $request)
    {
        //
    }

    public function show(InfoResidencial $infoResidencial)
    {
        //
    }

    public function edit(InfoResidencial $infoResidencial)
    {
        return view('admin.clientes.dados-residenciais.edit', [
            'dados' => $infoResidencial,
            'area' => 'Clientes',
            'page' => 'Editar Dados Residenciais',
            'rota' => 'admin.clientes.index'
        ]);
    }

    public function update(Request $request, InfoResidencial $infoResidencial)
    {
        $infoResidencial->update($request->all());
        alert()->success('Atualização', 'Atualização realizada com sucesso');
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoResidencial $infoResidencial)
    {
        //
    }
}
