<?php

namespace App\Http\Resources\Comissoes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TabelaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'descricao' => $this->descricao,
            'codigo' => $this->codigo,
            'produto_id' => $this->produto_id,
            'financeira_id' => $this->financeira_id,
            'correspondente_id' => $this->correspondente_id,
            'percentual_loja' => $this->percentual_loja,
            'percentual_agente' => $this->percentual_agente,
            'percentual_corretor' => $this->percentual_corretor,
            'parcelado' => $this->parcelado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
