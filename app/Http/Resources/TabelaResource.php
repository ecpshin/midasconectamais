<?php

namespace App\Http\Resources;

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
            'produto' => $this->produto,
            'percentual_loja' => $this->percentual_loja,
            'percentual_agente' => $this->percentual_agente,
            'percentual_corretor' => $this->percentual_corretor,
            'correspondente_id' => $this->correspondente_id,
            'financeira_id' => $this->financeira_id,
            'parcelado' => $this->parcelado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
