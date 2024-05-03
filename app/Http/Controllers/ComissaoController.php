<?php

namespace App\Http\Controllers;

use App\Models\Agente;
use App\Models\Comissao;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Produto;
use App\Models\Proposta;
use App\Models\Situacao;
use App\Models\Tabela;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;
use RealRashid\SweetAlert\Facades\Alert;

class ComissaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create comissao', ['only' => ['create', 'store']]);
        $this->middleware('can:delete comissao', ['only' => ['delete']]);
        $this->middleware('can:edit comissao', ['only' => ['edit']]);
        $this->middleware('can:update comissao', ['only' => ['update']]);
        $this->middleware('can:list comissao', ['only' => ['index']]);
        $this->middleware('can:view comissao', ['only' => ['show']]);
    }

    public function index(Request $request)
    {

        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $comissoes = Comissao::with(['proposta'])->get();
        $propostas = [];

        foreach ($comissoes as $com) {
            $propostas[] = $com->proposta;
        }
        $coll = collect($propostas);

        $fmt = new Number;

        return view('admin.comissoes.index', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'comissoes' => $comissoes,
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'loja' => $this->toMoeda($comissoes->sum('valor_loja') ?? 0),
            'agente' => $this->toMoeda($comissoes->sum('valor_agente') ?? 0),
            'corretor' => $this->toMoeda($comissoes->sum('valor_corretor') ?? 0),
            'total' => $this->toMoeda($coll->sum('total_proposta') ?? 0),
            'liquido' => $this->toMoeda($coll->sum('liquido_proposta') ?? 0),
            'fmt' => $fmt,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Comissao $comissao)
    {
        //
        return view('admin.comissoes.edit', [
            'area' => 'Comissões',
            'page' => 'Exibir Comissão',
            'rota' => 'admin.comissoes.index',
            'correspondentes' => Correspondente::all(),
            'financeiras' => Financeira::all(),
            'comissao' => $comissao,
            'produtos' => Produto::all(),
            'situacoes' => Situacao::all(),
            'tabelas' => Tabela::with(['correspondente', 'financeira', 'produto'])->get()
        ]);
    }

    public function edit(Comissao $comissao)
    {
        return view('admin.comissoes.edit', [
            'area' => 'Comissões',
            'page' => 'Editar Comissão',
            'rota' => 'admin.comissoes.index',
            'correspondentes' => Correspondente::all(),
            'financeiras' => Financeira::all(),
            'comissao' => $comissao,
            'produtos' => Produto::all(),
            'situacoes' => Situacao::all(),
            'tabelas' => Tabela::with(['correspondente', 'financeira', 'produto'])->get()
        ]);
    }

    public function update(Request $request, Comissao $comissao)
    {
        $comissao->update($request->all());
        Alert::success('OK', 'Comissão atualizada com sucesso');
        return redirect()->route('admin.comissoes.index');
    }

    public function destroy(Comissao $comissao)
    {
        $comissao->deleteOrFail();
        Alert::warning('OK', 'Comissão excluída');
        return redirect()->route('admin.comissoes.index');
    }

    public function porAgente(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $agente = $request->input('user_id') ? $request->input('user_id')  : null;

        $propostas = Proposta::with(['cliente', 'comissao', 'correspondente', 'financeira', 'produto', 'situacao', 'user'])
            ->whereMonth('data_digitacao', $mesAtual)
            ->whereNot('user_id', 1)
            ->get();

        if (!is_null($agente)) {
            $propostas = Proposta::with(['cliente', 'comissao', 'correspondente', 'financeira', 'operacao', 'situacao', 'user'])
                ->whereMonth('data_digitacao', $mesAtual)
                ->where('user_id', $agente)
                ->get();
        }

        $all = $propostas->map(function ($proposta) {
            return $proposta->comissao;
        });

        $fmt = new Number;

        return view('admin.comissoes.filtrar', [
            'area' => 'Comissões',
            'page' => 'Ajustar Comissão',
            'rota' => 'admin.comissoes.index',
            'propostas' => $propostas,
            'total_loja' => $this->toMoeda($all->sum('valor_loja') ?? 0),
            'total_agente' => $this->toMoeda($all->sum('valor_operador') ?? 0),
            'total_propostas' => $this->toMoeda($propostas->sum('total_proposta') ?? 0),
            'total_liquido' => $this->toMoeda($propostas->sum('liquido_proposta') ?? 0),
            'fmt' => $fmt,
            'months' => $this->getMonths(),
            'agentes' => $this->getAgentes(),
            'mesAtual' => $mesAtual
        ]);
    }

    public function getAgentes(): Collection
    {
        return User::select(['id', 'name'])->with('roles')->get();
    }

    private function getMonths()
    {
        return [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];
    }
    public function toMoeda($valor = 0.0, $currency = 'BRL', $locale = 'pt_BR'): string
    {
        return Number::currency($valor, $currency, $locale);
    }

    public function comissoesAgente(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $total = 0;
        $liquido = 0;
        $agente = 0;
        $propostas = [];
        $coll = [];

        $comissoes = Comissao::with(['proposta'])->get();

        if (count($request->all()) == 0) {
            foreach ($comissoes as $com) {
                $propostas[] = $com->proposta;
            }
            $coll = collect($propostas);
            $total = ($coll->sum('total_proposta'));
            $liquido = ($coll->sum('liquido_proposta'));
            $agente = $comissoes->sum('valor_agente');
        } else {
            $propostas = Proposta::with(['comissao'])->where('user_id', $request->user_id)->whereMonth('data_digitacao', $request->month)->get();
            $total = $propostas->sum('total_proposta');
            $liquido = $propostas->sum('liquido_proposta');
            $agente = 0;
        }

        $fmt = new Number;
        $users = User::with('roles')->where('tipo', 'agente')->get();

        return view('admin.comissoes.agentes', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'comissoes' => $comissoes ?? [],
            'users' => $users,
            'total' => $this->toMoeda($total ?? 0),
            'liquido' => $this->toMoeda($liquido ?? 0),
            'agente' => $this->toMoeda($agente ?? 0),
            'fmt' => $fmt
        ]);
    }

    public function comissoesCorretor(Request $request)
    {
        $comissoes = [];
        if (!$request->all()) {
            $comissoes = null;
        }
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $users = User::with('roles')->where('tipo', 'corretor')->get();
        return view('admin.comissoes.corretores', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'comissoes' => $comissoes,
            'agentes' => $users,
            // 'loja' => $this->toMoeda($comissoes->sum('valor_loja') ?? 0),
            // 'agente' => $this->toMoeda($comissoes->sum('valor_agente') ?? 0),
            // 'corretor' => $this->toMoeda($comissoes->sum('valor_corretor') ?? 0),
            // 'total' => $this->toMoeda($coll->sum('total_proposta') ?? 0),
            // 'liquido' => $this->toMoeda($coll->sum('liquido_proposta') ?? 0),
            // 'fmt' => $fmt,
        ]);
    }
}
