<?php

namespace App\Services;

use Illuminate\Support\Number;

class ConvertersService
{

    public $fmt = null;

    public function __construct()
    {
        $this->fmt = new Number;
    }

    public function toCurrencyBRL($valor)
    {
        return Number::currency(doubleval($valor), 'BRL', 'pt_BR');
    }

    public function toDecimal($valor, $digits)
    {
        return Number::format($valor, $digits, $digits, 'pt-BR');
    }

    public function toPercentage($valor, $digits)
    {
        return Number::percentage(doubleval($valor), $digits, $digits, 'pt_BR');
    }

    public function toDate($data = null)
    {
        return (!is_null($data)) ? date('d/m/Y', strtotime($data)) : 'Não informado';
    }
}
