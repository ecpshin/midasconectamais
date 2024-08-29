<?php

namespace App\Enums;
use Filament\Actions\Concerns\HasLabel;

enum TipoContaEnum: string implements HasLabel {
    case CONTA_CORRENTE = 'Conta Corrente';
    case CONTA_POUPANCA = 'Conta Poupança';
    case CONTA_SALARIO = 'Conta Salário';
    case CONTA_DIGITAL = 'Conta Digital';
    case OUTROS = 'OUTROS';


}
