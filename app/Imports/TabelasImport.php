<?php

namespace App\Imports;

use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Tabela;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class TabelasImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row): Tabela
    {
        return new Tabela([
            'produto_id' => $row['produto_id'],
            'financeira_id' => $row['financeira_id'],
            'correspondente_id' => $row['correspondente_id'],
            'organizacao_id' => $row['organizacao_id'],
            'descricao' => $row['descricao'],
            'codigo' => $row['codigo'],
            'percentual_loja' => $row['percentual_loja'],
            'percentual_diferido' => $row['percentual_diferido'],
            'percentual_agente' => $row['percentual_agente'],
            'percentual_corretor' => $row['percentual_corretor'],
            'prazo' => $row['prazo'],
            'referencia' => $row['referencia'],
            'parcelado' => $row['parcelado'],
        ]);
    }
}
