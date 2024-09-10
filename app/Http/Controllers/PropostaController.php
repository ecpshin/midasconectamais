<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePropostaRequest;
use App\Models\Cliente;
use App\Models\Proposta;
use App\Models\Tabela;
use App\Models\User;
use App\Services\ConvertersService;
use App\Services\GeneralService;
use App\Services\PropostaService;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Ramsey\Uuid\Uuid;
use RealRashid\SweetAlert\Facades\Alert;

class PropostaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // $this->middleware('can:create proposta', ['only' => ['create', 'proposda', 'store', 'special']]);
        // $this->middleware('can:edit proposta', ['only' => ['edit', 'update']]);
        // $this->middleware('can:update proposta', ['only' => ['update']]);
        // $this->middleware('can:list proposta', ['only' => ['index']]);
        // $this->middleware('can:view proposta', ['only' => ['show']]);
    }

    public function index()
    {
        $svc = new GeneralService;
        $fmt = new ConvertersService;
        $svcPropostas = new PropostaService;

        $propostas = (auth()->user()->hasRole('super-admin')) ? $svcPropostas->propostas() : $svcPropostas->propostas(auth()->user()->id);

        return view('admin.propostas.index', [
            'area' => 'Propostas',
            'page' => 'Visão Geral',
            'rota' => 'admin.propostas.index',
            'agentes' => $svc->agentes(['id', 'name', 'tipo']),
            'propostas' => $propostas,
            'produtos' => $svc->produtos(['id', 'descricao_produto']),
            'correspondentes' => $svc->correspondentes(['id', 'nome_correspondente']),
            'financeiras' => $svc->clientes(['id', 'nome', 'cpf']),
            'situacoes' => $svc->situacoes(['id', 'descricao_situacao', 'motivo_situacao']),
            'soma_totais' => $propostas->sum('total_proposta'),
            'soma_liquidos' => $propostas->sum('liquido_proposta'),
            "fmt" => $fmt
        ]);
    }

    public function create()
    {
        $svc = new GeneralService;

        $auxs = $svc->agentes();

        $agentes = $auxs->filter(function ($aux) {
            return $aux->tipo == 'agente';
        });

        $corretores = $auxs->filter(function ($aux) {
            return $aux->tipo == 'corretores';
        });

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
            'uuid' => substr((string) Uuid::uuid4(), 0, 13),
            'agentes' => $agentes,
            'corretores' => $corretores
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
        $id = is_null($request->user_id) ? auth()->user()->id : $request->user_id;

        $attributes = $request->validated();
        $attributes['user_id'] = $id;
        $cliente = Cliente::find($request->cliente_id);
        $proposta = $cliente->propostas()->create($attributes);
        $proposta->comissao()->create($request->all());


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
            'orgaos' => $svc->organizacoes(['id', 'nome_organizacao']),
            'produtos' => $svc->produtos(),
            'situacoes' => $svc->situacoes(),
            'tabelas' => $svc->tabelas(),
            'proposta' => $proposta
        ]);
    }

    public function update(Request $request, Proposta $proposta)
    {
        $attributes = $request->only(['tabela_id', 'organizacao_id', 'percentual_loja', 'valor_loja', 'percentual_agente', 'valor_agente', 'percentual_corretor', 'valor_corretor']);
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
        $soma_liquidos = 0;
        $soma_totais = 0;

        if ($req->inicio && $req->fim) {
            $inicio = $req->inicio;
            $fim = $req->fim;
            $propostas = $psvc->propostasPorIntervalo($inicio, $fim);
            $soma_totais = $psvc->somaTotais($propostas);
            $soma_liquidos = $psvc->somaLiquidos($propostas);
        }


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
            'soma_totais' => $soma_totais,
            'soma_liquidos' => $soma_liquidos,
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
