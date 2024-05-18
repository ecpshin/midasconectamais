<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comissoes\TabelasResource;
use App\Models\Cliente;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Produto;
use App\Models\Tabela;
use App\Models\User;
use Illuminate\Http\Request;
use Str;

class TesteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::with(['vinculos'])->first();

        return view('testes.index', [
            'cliente' => $cliente,
            'financeiras' => Financeira::all(['id', 'nome_financeira']),
            'correspondentes' => Correspondente::all(['id', 'nome_correspondente']),
            'produtos' => Produto::all(['id', 'descricao_produto']),
            'uuid' => Str::uuid()
        ]);
    }
}
