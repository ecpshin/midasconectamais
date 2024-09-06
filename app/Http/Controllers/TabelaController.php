<?php

namespace App\Http\Controllers;

use App\Exports\Tabelas\TabelasExport;
use App\Http\Requests\Tabelas\StoreTabelaRequest;
use App\Imports\TabelasImport;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Produto;
use App\Models\Tabela;
use App\Services\ConvertersService;
use App\Services\GeneralService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Maatwebsite\Excel\Facades\Excel;
use Number;
use RealRashid\SweetAlert\Facades\Alert;

class TabelaController extends Controller
{

    public $fmt = null;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create tabela-comissao', ['only' => ['create', 'store']]);
        $this->middleware('can:list tabela-comissao', ['only' => ['index']]);
        $this->middleware('can:view tabela-comissao', ['only' => ['show']]);
        $this->middleware('can:edit tabela-comissao', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete tabela-comissao', ['only' => ['destroy']]);
        $this->middleware('can:import tabela-comissao', ['only' => ['import']]);
        $this->middleware('can:export tabela-comissao', ['only' => ['export']]);
        $this->fmt = new Number;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Tabela::orderBy('financeira_id', 'asc')->get();

        $fins = $tables->groupBy('financeira_id');

        return view('admin.tabelas.index', [
            'area' => 'Tabelas',
            'page' => 'Tabelas de Comissões Registradas',
            'rota' => 'admin',
            'tabelas' => $tables,
            'fmt' => $this->fmt
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fmt = new ConvertersService;
        $geralSvc = new GeneralService;

        return view('admin.tabelas.create', [
            'area' => 'Tabelas',
            'page' => 'Registrar Tabela Comissão',
            'rota' => 'admin',
            'correspondentes' => $geralSvc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $geralSvc->financeiras(['id', 'nome_financeira']),
            'orgaos' => $geralSvc->organizacoes(['id', 'nome_organizacao']),
            'produtos' => $geralSvc->produtos(),
            'fmt' => $fmt
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabelaRequest $request)
    {
        $attributes = $request->validated();
        Tabela::create($attributes);
        Alert::success('Sucesso', 'Tabela de comissão registrada com sucesso!');
        return redirect()->route('admin.tabelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tabela $tabela)
    {
        $fmt = new ConvertersService;
        $geralSvc = new GeneralService;

        return view('admin.tabelas.edit', [
            'area' => 'Restrita',
            'page' => 'Exibindo Tabela de Comissão',
            'rota' => 'admin.tabelas.index',
            'tabela' => $tabela,
            'correspondentes' => $geralSvc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $geralSvc->financeiras(['id', 'nome_financeira']),
            'organizacoes' => $geralSvc->organizacoes(['id', 'nome_organizacao']),
            'produtos' => $geralSvc->produtos(),
            'fmt' => $fmt
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabela $tabela)
    {
        $fmt = new ConvertersService;
        $geralSvc = new GeneralService;

        return view('admin.tabelas.edit', [
            'area' => 'Tabelas',
            'page' => 'Editar Tabela de Comissão',
            'rota' => 'admin.tabelas.index',
            'tabela' => $tabela,
            'correspondentes' => $geralSvc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $geralSvc->financeiras(['id', 'nome_financeira']),
            'organizacoes' => $geralSvc->organizacoes(['id', 'nome_organizacao']),
            'produtos' => $geralSvc->produtos(),
            'fmt' => $fmt
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabela $tabela)
    {
        $tabela->update($request->all());
        alert()->success('Sucesso', 'Tabela foi atualizada com sucesso');
        return redirect(route('admin.tabelas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabela $tabela)
    {
        $tabela->delete();
        Alert::warning('Exclusão', 'Exclusão da tabela de código ' . $tabela->codigo . 'realizada com sucesso!');
        return redirect()->back();
    }

    public function import(Request $request)
    {
        return Excel::import(new TabelasImport, $request->file('file'));
    }

    public function export($extension = 'xlsx')
    {
        return (new TabelasExport)->download('tabelas-comissoes-' . now() . '.' . $extension, ExcelWriter::XLSX);
    }
}
