<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EstadoCivilEnum: string implements HasLabel
{

    case CASADO = 'Casado(a)';
    case DESQUITADO = 'Desquitado(a)';
    case DIVORCIADO = 'Divorciado(a)';
    case FALECIDO = 'Falecido(a)';
    case SEPARADO = 'Separado(a)';
    case SOLTEIRO = 'Solteiro(a)';
    case UNIAO_ESTAVEL = 'União estável';
    case UNIAO_MESMO_SEXO = 'União estável com mesmo sexo';
    case OUTROS = 'Outros';

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->name;
    }
}