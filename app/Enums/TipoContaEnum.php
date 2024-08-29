<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TipoContaEnum: string implements HasLabel
{
    case CONTA_CORRENTE = 'Conta Corrente';
    case CONTA_POUPANCA = 'Conta Poupança';
    case CONTA_SALARIO = 'Conta Salário';
    case CONTA_DIGITAL = 'Conta Digital';
    case OUTROS = 'OUTROS';


    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return match($this) {
            self::CONTA_CORRENTE => 'Conta Corrente',
            self::CONTA_POUPANCA => 'Conta Poupança',
            self::CONTA_DIGITAL => 'Conta Digital',
            self::CONTA_SALARIO => 'Conta Salário',
            self::OUTROS => 'Outros'
        };
    }
}
