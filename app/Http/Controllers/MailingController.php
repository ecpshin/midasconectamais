<?php

namespace App\Http\Controllers;

use Alert;
use App\Imports\MailingImport;
use App\Models\Mailing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MailingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('can:create mailing', ['only' => ['create', 'store']]);
        $this->middleware('can:delete mailing', ['only' => ['destroy']]);
        $this->middleware('can:edit mailing', ['only' => ['edit', 'update']]);
        $this->middleware('can:import mailing', ['only' => ['import']]);
        $this->middleware('can:list mailing', ['only' => ['index']]);
        $this->middleware('can:view mailing', ['only' => ['show', 'list']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mailings = Mailing::where('user_id', auth()->user()->id)->get();

        return view('mailings.index', [
            'area' => 'Mailings',
            'page' => 'Lista Mailings',
            'rota' => 'admin.mailings.index',
            'mailings' => $mailings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mailings.create', [
            'area' => 'Mailings',
            'page' => 'Carregar Mailing',
            'rota' => 'admin.mailings.index'
        ]);
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
    public function show(Mailing $mailing)
    {
        return response()->json($mailing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mailing $mailing)
    {
        return view('mailings.edit', [
            'area' => 'Mailings',
            'page' => 'Carregar Mailing',
            'rota' => 'admin.mailings.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mailing $mailing)
    {
        $mailing->update($request->all());
        Alert::success('Ok', 'Atualização realizada com sucesso!');
        return redirect()->route('admin.mailings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mailing $mailing)
    {
        $mailing->forceDelete();
        Alert::success('Ok', 'Exclusão realizada com sucesso!');
        return redirect()->route('admin.mailings.index');
    }

    public function import(Request $request)
    {
        if (empty($request->allFiles())) {
            return redirect()->back()->with('error', 'Selecione um arquivo');
        }
        Excel::import(new MailingImport, $request->file('mailing'));
        return redirect()->route('admin.mailings.index')->with('success', 'Legal arquivo carregado com sucesso!');
    }

    private function getRandomList(Collection $collection): Collection
    {
        return $collection->random(fn (Collection $items) => min(50, count($items)));
    }
}
