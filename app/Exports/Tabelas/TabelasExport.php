<?php

namespace App\Exports\Tabelas;

use App\Models\Tabela;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TabelasExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tabela::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'produto_id',
            'financeira_id',
            'correspondente_id',
            'organizacao_id',
            'descricao',
            'codigo',
            'prazo',
            'parcelado',
            'referencia',
            'percentual_loja',
            'bonus',
            'percentual_diferido',
            'comissao_total',
            'percentual_agente',
            'percentual_corretor',
            'created_at',
            'update_at',
            'deleted_at'
        ];
    }
}
