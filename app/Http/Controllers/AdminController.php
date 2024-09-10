<?php

namespace App\Http\Controllers;


use App\Models\Ligacao;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function admin()
    {
        return view('auth.login');
    }
}
