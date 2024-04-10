<?php

namespace App\Services;

use Number;

class ConvertersService
{

    public $fmt = null;

    public function __construct()
    {
        $this->fmt = new Number;
    }

    public function toCurrencyBRL($valor)
    {
        return $this->fmt->currency($valor, 'BRL', 'pt-BR');
    }

    public function toDecimal($valor, $digits)
    {
        return $this->fmt->format($valor, $digits, $digits, 'pt-BR');
    }
}
