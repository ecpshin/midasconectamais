<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clientes\ClienteStoreRequest;
use App\Http\Requests\StorePropostaRequest;
use App\Models\Cliente;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Proposta;
use App\Models\Situacao;
use App\Models\User;
use App\Services\ConvertersService;
use App\Services\GeneralService;


use App\Services\PropostaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class PropostaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create proposta', ['only' => ['create']]);
        $this->middleware('can:edit proposta', ['only' => ['edit', 'update']]);
        $this->middleware('can:update proposta', ['only' => ['update']]);
        $this->middleware('can:list proposta', ['only' => ['index']]);
        $this->middleware('can:view proposta', ['only' => ['show']]);
    }

    public function index()
    {
        $svc = new GeneralService;
        $fmt = new ConvertersService;

        return view('admin.propostas.index', [
            'area' => 'Propostas',
            'page' => 'Visão Geral',
            'rota' => 'admin.propostas.index',
            'agentes' => $svc->agentes(['id', 'name', 'tipo']),
            'propostas' => $svc->propostas(),
            'produtos' => $svc->produtos(['id', 'descricao_produto']),
            'correspondentes' => $svc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $svc->clientes(['id', 'nome', 'cpf']),
            'situacoes' => $svc->situacoes(['id', 'descricao_situacao', 'motivo_situacao']),
            'soma_totais' => 0,
            'soma_liquidos' => 0,
            "fmt" => $fmt
        ]);
    }

    public function create()
    {
        $svc = new GeneralService;
        $uuid = Uuid::uuid4();

        return view('admin.propostas.create', [
            'area' => 'Propostas',
            'page' => 'Lançamento de Proposta',
            'rota' => 'admin.propostas.index',
            'clientes' => $svc->clientes(['id', 'nome', 'cpf']),
            'correspondentes' => $svc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $svc->financeiras(['id', 'nome_financeira']),
            'situacoes' => $svc->situacoes(['id', 'descricao_situacao', 'motivo_situacao']),
            'produtos' => $svc->produtos(['id', 'descricao_produto']),
            'tabelas' => $svc->tabelas(),
            'orgaos' => $svc->organizacoes(['id', 'nome_organizacao']),
            'uuid' => substr($uuid, 0, 13)
        ]);
    }


    public function special(StorePropostaRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();
        $request['user_id'] = auth()->id();
        $cliente = Cliente::create($request->all());
        $proposta = $cliente->propostas()->create($attributes);
        $proposta->comissao()->create($attributes);

        if ($proposta instanceof Proposta) {
            alert()->success('Sucesso', 'Lançamento de proposta realizado com sucesso.');
            return redirect(route('admin.propostas.index'));
        }
    }
    public function store(StorePropostaRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();
        $request['user_id'] = auth()->id();
        $cliente = Cliente::find($request->cliente_id);
        $proposta = $cliente->propostas()->create($attributes);
        $proposta->comissao()->create($attributes);

        if ($proposta instanceof Proposta) {
            alert()->success('Sucesso', 'Lançamento de proposta realizado com sucesso.');
            return redirect(route('admin.propostas.index'));
        }
    }

    public function show(Proposta $proposta)
    {
        $svc = new GeneralService;

        return view('admin.propostas.edit', [
            'area' => 'Propostas',
            'page' => 'Editar Dados de Proposta',
            'rota' => 'admin.propostas.index',
            'clientes' => Cliente::select(['id', 'nome', 'cpf'])->get(),
            'correspondentes' => $svc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $svc->financeiras(['id', 'nome_financeira']),
            'operacoes' => $svc->produtos(['id', 'descricao_produto']),
            'situacoes' => $svc->situacoes(['id', 'descricao_situacao', 'motivo_situacao']),
            'proposta' => $proposta
        ]);
    }

    public function edit(Proposta $proposta)
    {
        $svc = new GeneralService;

        return view('admin.propostas.edit', [
            'area' => 'Propostas',
            'page' => 'Editar Dados de Proposta',
            'rota' => 'admin.propostas.index',
            'clientes' => Cliente::select(['id', 'nome', 'cpf'])->get(),
            'correspondentes' => $svc->correspondentes(),
            'financeiras' => $svc->financeiras(),
            'operacoes' => $svc->produtos(),
            'situacoes' => $svc->situacoes(),
            'proposta' => $proposta
        ]);
    }

    public function update(Request $request, Proposta $proposta)
    {
        $request['user_id'] = $request->user()->id;
        $attributes = $request->only(['tabela_comissao', 'percentual_loja', 'valor_loja', 'percentual_operador', 'valor_operador']);
        $proposta->update($request->all());
        $proposta->comissao()->update($attributes);
        return redirect()->route('admin.propostas.index')->with('success', 'Proposta atualizada com sucesso.');
    }

    public function destroy(Proposta $proposta)
    {
        $proposta->delete();
        Alert::warning('Ohh', 'Proposta excluída com sucesso.');
        return redirect()->route('admin.propostas.index');
    }

    public function propostasAgente(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $users = User::with('roles')->where('tipo', 'agente')->get();
        $soma_total = 0;
        $soma_liquido = 0;
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

        $soma_total = $propostas->sum('total_proposta');
        $soma_liquido = $propostas->sum('liquido_proposta');

        $fmt = new Number;

        return view('admin.propostas.agente', [
            'area' => 'Propostas',
            'page' => 'Propostas Lançadas',
            'rota' => 'admin.propostas.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'propostas' => $propostas ?? [],
            'agentes' => $users,
            'soma_total' => $this->toMoeda($soma_total ?? 0),
            'soma_liquido' => $this->toMoeda($soma_liquido ?? 0),
            'fmt' => $fmt
        ]);
    }

    public function propostasCorretor(Request $request)
    {
        $mesAtual = $request->input('month') ? $request->input('month')  : date('m');
        $users = User::with('roles')->where('tipo', 'corretor')->get();
        $soma_total = 0;
        $soma_liquido = 0;
        $propostas = [];

        if (count($request->all()) > 0) {
            $user = $request->user_id;
            $mes = $request->month;
            $propostas = Proposta::where(function ($query) use ($user, $mes) {
                $query->where('user_id', $user)->whereMonth('data_digitacao', $mes);
            })->get();
        } else {
            $propostas = Proposta::with(['comissao', 'user'])->get();
        }

        foreach ($propostas as $p) {
            $aux[] = $p->comissao;
        }

        $soma_total = $propostas->sum('total_proposta');
        $soma_liquido = $propostas->sum('liquido_proposta');

        $fmt = new Number;

        return view('admin.propostas.corretor', [
            'area' => 'Propostas',
            'page' => 'Propostas Lançadas',
            'rota' => 'admin.propostas.index',
            'months' => $this->getMonths(),
            'mesAtual' => $mesAtual,
            'propostas' => $propostas ?? [],
            'agentes' => $users,
            'soma_total' => $this->toMoeda($soma_total ?? 0),
            'soma_liquido' => $this->toMoeda($soma_liquido ?? 0),
            'fmt' => $fmt
        ]);
    }

    public function filtrarPropostas(Request $req)
    {
        $propostas = [];
        $psvc = new PropostaService;
        $svc = new GeneralService;
        $fmt = new ConvertersService;

        if ($req->inicio && $req->fim) {
            $inicio = $req->inicio;
            $fim = $req->fim;
            $propostas = $psvc->propostasPorIntervalo($inicio, $fim);
        }

        $soma_totais = $psvc->somaTotais($propostas);
        $soma_liquidos = $psvc->somaTotais($propostas);

        return view('admin.propostas.index', [
            'area' => 'Propostas',
            'page' => 'Filtrar de Proposta',
            'rota' => 'admin.propostas.index',
            'propostas' => $propostas,
            'correspondentes' => $svc->correspondentes(),
            'financeiras' => $svc->financeiras(),
            'produtos' => $svc->produtos(),
            'situacoes' => $svc->statuses(),
            'orgaos' => $svc->organizacoes(),
            'soma_totais' => $soma_totais ?? 0,
            'soma_liquidos' => $soma_liquidos ?? 0,
            'fmt' => $fmt
        ]);
    }

    public function pordata(Request $request)
    {
        if (!$request->all(['inicio'])) {
            toast('Sem resultados', 'warning', 'top-right');
            return redirect()->route('admin.propostas.por-intervalo');
        }

        $filtro = [];
        $inicio = $request->input('inicio');
        $final = $request->input('final');

        if (auth()->user()->hasRole('super-admin')) {
            $filtro = Proposta::where('data_digitacao', '>=', $inicio)
                ->where('data_digitacao', '<=', $final)
                ->orderBy('user_id', 'DESC')->get();
        } else {
            $filtro = Proposta::where('data_digitacao', '>=', $inicio)
                ->where('data_digitacao', '<=', $final)
                ->where('user_id', $request->user('web')->id)
                ->orderBy('user_id', 'DESC')->get();
        }
        return view('admin.propostas.interval', [
            'area' => 'Propostas',
            'page' => 'Filtrar de Proposta',
            'rota' => 'admin.propostas.index',
            'propostas' => $filtro
        ]);
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
}
