<?php

namespace App\Http\Controllers;

use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Tabela;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function admin()
    {
        return view('main', [
            'page' => 'Administração do Sistema',
            'area' => 'Administração',
            'rota' => 'admin',
        ]);
    }
}
