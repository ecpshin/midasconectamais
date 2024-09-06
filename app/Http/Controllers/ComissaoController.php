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
use App\Services\ComissoesService;
use App\Services\ConvertersService;
use App\Services\GeneralService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use RealRashid\SweetAlert\Facades\Alert;

class ComissaoController extends Controller
{
    public $svc = null;
    public $fmt;

    public function __construct()
    {
        $this->middleware('can:create comissao', ['only' => ['create', 'store']]);
        $this->middleware('can:delete comissao', ['only' => ['delete']]);
        $this->middleware('can:edit comissao', ['only' => ['edit']]);
        $this->middleware('can:update comissao', ['only' => ['update']]);
        $this->middleware('can:list comissao', ['only' => ['index']]);
        $this->middleware('can:view comissao', ['only' => ['show']]);
        $this->svc = new GeneralService;
        $this->fmt = new ConvertersService;
    }

    public function index(Request $request)
    {
        $mesAtual = !empty($request->all()) ? $request->month : date('m');
        $users = User::with('roles')->get();
        $soma_total = 0;
        $soma_liquido = 0;
        $soma_loja = 0;
        $soma_agente = 0;
        $soma_corretor = 0;
        $propostas = [];
        $comissoes = [];
        $aux = [];

        $service = new ComissoesService;

        if (!empty($request->all())) {
            $propostas = $service->comissoesAgente($mesAtual);
        } else {
            $propostas = $service->comissoesAgente();
        }

        foreach ($propostas as $p) {
            $aux[] = $p->comissao;
        }

        if (count($aux) > 0) {
            $comissoes = collect($aux);
            $soma_loja = $comissoes->sum('valor_loja');
            $soma_agente = $comissoes->sum('valor_agente');
            $soma_corretor = $comissoes->sum('valor_corretor');
        }

        $soma_total = $propostas->sum('total_proposta');
        $soma_liquido = $propostas->sum('liquido_proposta');

        return view('admin.comissoes.index', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'comissoes' => $comissoes ?? [],
            'users' => $users,
            'soma_total' => $this->fmt->toCurrencyBRL($soma_total ?? 0),
            'soma_liquido' => $this->fmt->toCurrencyBRL($soma_liquido ?? 0),
            'soma_loja' => $this->fmt->toCurrencyBRL($soma_loja ?? 0),
            'soma_agente' => $this->fmt->toCurrencyBRL($soma_agente ?? 0),
            'soma_corretor' => $this->fmt->toCurrencyBRL($soma_corretor ?? 0),
            'fmt' => $this->fmt
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

        return view('admin.comissoes.filtrar', [
            'area' => 'Comissões',
            'page' => 'Ajustar Comissão',
            'rota' => 'admin.comissoes.index',
            'propostas' => $propostas,
            'total_loja' => $this->toMoeda($all->sum('valor_loja') ?? 0),
            'total_agente' => $this->toMoeda($all->sum('valor_operador') ?? 0),
            'total_propostas' => $this->toMoeda($propostas->sum('total_proposta') ?? 0),
            'total_liquido' => $this->toMoeda($propostas->sum('liquido_proposta') ?? 0),
            'fmt' => $this->fmt,
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
        $mesAtual = !is_null($request->month) ? $request->month : date('m');
        $users = User::with('roles')->where('tipo', 'agente')->get();
        $soma_total = 0;
        $soma_liquido = 0;
        $soma_agente = 0;
        $propostas = [];
        $comissoes = [];
        $aux = [];

        if (count($request->all()) > 0) {
            $user = $request->user_id;
            $mes = $request->month;
            $propostas = Proposta::with(['comissao', 'user'])->where(function ($query) use ($user, $mes) {
                $query->where('user_id', $user)->whereMonth('data_digitacao', $mes);
            })->get();
        } else {
            $propostas = Proposta::with(['comissao', 'user'])->get();
        }

        foreach ($propostas as $p) {
            $aux[] = $p->comissao;
        }

        if (count($aux) > 0) {
            $comissoes = collect($aux);
            $soma_agente = $comissoes->sum('valor_agente');
            $soma_total = $propostas->sum('total_proposta');
            $soma_liquido = $propostas->sum('liquido_proposta');
        }

        $fmt = new ConvertersService;

        return view('admin.comissoes.agentes', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'comissoes' => $comissoes ?? [],
            'users' => $users,
            'soma_total' => $this->toMoeda($soma_total ?? 0),
            'soma_liquido' => $this->toMoeda($soma_liquido ?? 0),
            'soma_agente' => $this->toMoeda($soma_agente ?? 0),
            'fmt' => $fmt
        ]);
    }

    public function comissoesCorretor(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $users = User::with('roles')->where('tipo', 'corretor')->get();
        $soma_total = 0;
        $soma_liquido = 0;
        $soma_agente = 0;
        $propostas = [];

        if (count($request->all()) > 0) {
            $user = $request->user_id;
            $mes = $request->month;
            $propostas = Proposta::with(['comissao', 'user'])->where(function ($query) use ($user, $mes) {
                $query->where('user_id', $user)->whereMonth('data_digitacao', $mes);
            })->get();
        } else {
            $propostas = Proposta::with(['comissao', 'user'])->get();
        }

        foreach ($propostas as $p) {
            $aux[] = $p->comissao;
        }

        $comissoes = collect($aux);
        $soma_agente = $comissoes->sum('valor_agente');
        $soma_total = $propostas->sum('total_proposta');
        $soma_liquido = $propostas->sum('liquido_proposta');

        $fmt = new Number;

        return view('admin.comissoes.corretores', [
            'area' => 'Comissões',
            'page' => 'Comissões Lançadas',
            'rota' => 'admin.comissoes.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'comissoes' => $comissoes ?? [],
            'agentes' => $users,
            'soma_total' => $this->toMoeda($soma_total ?? 0),
            'soma_liquido' => $this->toMoeda($soma_liquido ?? 0),
            'soma_agente' => $this->toMoeda($soma_agente ?? 0),
            'fmt' => $fmt
        ]);
    }
}
