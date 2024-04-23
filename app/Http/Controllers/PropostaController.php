<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Produto;
use App\Models\Proposta;
use App\Models\Situacao;
use App\Models\Tabela;
use App\Models\User;
use App\Services\ConvertersService;
use App\Services\OperacoesService;
use App\Services\SelectsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Number;
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
        return view('admin.propostas.index', [
            'area' => 'Propostas',
            'page' => 'Propostas Lançadas',
            'rota' => 'admin.propostas.index',
            'propostas' => $this->getPropostas(),
            'produtos' => Produto::all(['id', 'descricao_produto']),
            'correspondentes' => $this->getCorrespondentes(),
            'financeiras' => $this->getFinanceiras(),
            'situacoes' => $this->getSituacoes(),
            "fmt" => new ConvertersService
        ]);
    }

    public function create()
    {
        $correspondentes = Correspondente::all();
        $financeiras = Financeira::all();
        $situacoes = Situacao::all();
        $tabelas = Tabela::all();
        $uuid = Uuid::uuid4();

        return view('admin.propostas.create', [
            'area' => 'Propostas',
            'page' => 'Lançamento de Proposta',
            'rota' => 'admin.propostas.index',
            'clientes' => Cliente::all(),
            'correspondentes' => $correspondentes,
            'financeiras' => $financeiras,
            'produtos' => Produto::all(['id', 'descricao_produto']),
            'situacoes' => $situacoes,
            'tabelas' => $tabelas,
            'uuid' => substr($uuid, 0, 13)
        ]);
    }

    public function store(Request $request)
    {
        $request['user_id'] = $request->user()->id;
        $proposta = Proposta::create($request->all());

        if ($proposta instanceof Proposta) {
            $proposta->comissao()->create($request->all());
            alert()->success('Sucesso', 'Lançamento de proposta realizado com sucesso.');
            return redirect(route('admin.propostas.index'));
        }
    }

    public function show(Proposta $proposta)
    {
        //
    }

    public function edit(Proposta $proposta)
    {
        return view('admin.propostas.edit', [
            'area' => 'Propostas',
            'page' => 'Editar Dados de Proposta',
            'rota' => 'admin.propostas.index',
            'clientes' => Cliente::select(['id', 'nome', 'cpf'])->get(),
            'correspondentes' => $this->getCorrespondentes(),
            'financeiras' => $this->getFinanceiras(),
            'operacoes' => $this->getOperacoes(),
            'situacoes' => $this->getSituacoes(),
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
        //
    }

    public function pagePropostaPorAgente()
    {
        if (auth()->user()->hasRole(['super-admin'])) {
            $agentes = User::withoutRole(['super-admin'])->whereNot('id', auth()->user()->id)->get();
        }

        return view('admin.propostas.producao-mensal', [
            'area' => 'Propostas',
            'page' => 'Produção Mensal Agente',
            'rota' => 'admin.propostas.index',
            'propostas' => [],
            'agentes' => $agentes,
            'meses' => $this->getMonths(),
            'fmt' => new Number
        ]);
    }

    public function producaoPorAgente(Request $request)
    {
        if (!$request->input('mes')) {
            return redirect()->back()->with('error', 'Selecione o mês.');
        }

        if (!$request->input('user_id')) {
            return redirect()->back()->with('error', 'Selecione o agente.');
        }

        if (auth()->user()->hasRole(['super-admin'])) {
            $agentes = User::withoutRole(['super-admin'])->whereNot('id', auth()->user()->id)->get();
        }

        $propostas = Proposta::whereMonth('data_digitacao', $request->input('mes'))
            ->where('user_id', $request->input('user_id'))->paginate(5);

        $total_propostas = $propostas->sum('total_proposta');

        $liquido_propostas = $propostas->sum('liquido_proposta');

        $fmt = new Number;

        return view('admin.propostas.producao-mensal', [
            'area' => 'Propostas',
            'page' => 'Produção Mensal Agente',
            'rota' => 'admin.propostas.index',
            'propostas' => $propostas,
            'agentes' => $agentes,
            'meses' => $this->getMonths(),
            'fmt' => $fmt,
            'total_propostas' => $total_propostas,
            'liquido_propostas' => $liquido_propostas
        ]);
    }

    public function filtrarPorData()
    {
        return view('admin.propostas.filtrar', [
            'area' => 'Propostas',
            'page' => 'Filtrar de Proposta',
            'rota' => 'admin.propostas.index',
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

    private function getFinanceiras(): Collection
    {
        return Financeira::select(['id', 'nome_financeira'])->get();
    }

    private function getCorrespondentes(): Collection
    {
        return Correspondente::select(['id', 'nome_correspondente'])->get();
    }
    private function getOperacoes(): Collection
    {
        $operacoes = new OperacoesService();
        return $operacoes->getOperacoes();
    }

    private function getPropostas(): Collection
    {
        return Proposta::all();
    }

    private function getSituacoes(): Collection
    {
        return Situacao::select(['id', 'descricao_situacao'])->get();
    }

    public function getpercentual($id)
    {
        return Correspondente::select('percentual_comissao')->where('id', $id);
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

    public function toMoeda($valor, $currency, $locale)
    {
        return Number::currency($valor, $currency, $locale);
    }
}
