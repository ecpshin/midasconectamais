<?php

namespace App\Http\Controllers;

use App\Models\Ligacao;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function cliente(Ligacao $id){
        return Ligacao::where('id', $id->id)->get();
    }
}
