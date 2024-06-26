<?php

namespace App\Imports\Tabelas;

use App\Models\Tabela;
use Maatwebsite\Excel\Concerns\ToModel;

class TabelasImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Tabela([
            'produto_id' => $row[0],
            'financeira_id' => $row[1],
            'correspondente_id' => $row[2],
            'organizacao_id' => $row[3],
            'descricao' => $row[4],
            'codigo' => $row[5],
            'percentual_loja' => $row[6],
            'percentual_diferido' => $row[7],
            'percentual_agente' => $row[8],
            'percentual_corretor' => $row[9],
            'prazo' => $row[10],
            'referencia' => $row[11],
            'parcelado' => $row[12],
        ]);
    }
}
