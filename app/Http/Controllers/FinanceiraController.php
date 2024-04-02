<?php

namespace App\Http\Controllers;

use App\Http\Requests\Financeiras\FinanceirasStoreRequest;
use App\Models\Financeira;
use Illuminate\Http\Request;

class FinanceiraController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:create financeira', ['only' => ['create', 'store']]);
        $this->middleware('can:delete financeira', ['only' => ['destroy']]);
        $this->middleware('can:edit financeira', ['only' => ['edit', 'update']]);
        $this->middleware('can:list financeira', ['only' => ['index']]);
        $this->middleware('can:update financeira', ['only' => ['update']]);
        $this->middleware('can:view financeira', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financeiras = Financeira::paginate(5);
        return view('financeiras.index', [
            'financeiras' => $financeiras,
            'area' => 'Financeiras',
            'page' => 'Financeiras Cadastradas',
            'rota' => 'admin.financeiras.index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiras.create', [
            'area' => 'Financeiras',
            'page' => 'Cadastrar Financeira',
            'rota' => 'admin.financeiras.index'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinanceirasStoreRequest $request)
    {
        $attributes = $request->validated();
        Financeira::create($attributes);
        alert()->success('Sucesso', 'Cadastro realizado com sucesso!');
        return redirect()->route('admin.financeiras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Financeira $financeira)
    {
        return view('financeiras.show', [
            'financeira' => $financeira,
            'area' => 'Financeiras',
            'page' => 'Exibir dado(s) Financeira',
            'rota' => 'admin.financeiras.index'
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Financeira $financeira)
    {
        return view('financeiras.edit', [
            'financeira' => $financeira,
            'area' => 'Financeiras',
            'page' => 'Atualizar Financeira',
            'rota' => 'admin.financeiras.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinanceirasStoreRequest $request, Financeira $financeira)
    {
        $attributes = $request->validated();
        $financeira->update($attributes);
        alert()->success('Sucesso', 'Atualização realizada com sucesso!');
        return redirect()->route('admin.financeiras.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Financeira $financeira)
    {
        //
    }
}
