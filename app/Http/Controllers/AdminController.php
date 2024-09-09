<?php

namespace App\Http\Controllers;


use App\Models\Ligacao;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function admin()
    {
        $count = Ligacao::where(function($query){
            $query->whereUserId(auth()->id())->whereNotNull('data_agendamento');
        })->get()->count();

        return view('main', [
            'page' => 'Administração do Sistema',
            'area' => 'Administração',
            'rota' => 'admin',
            'count' => $count
        ]);
    }
}
