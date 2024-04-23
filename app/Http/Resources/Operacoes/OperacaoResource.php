<?php

namespace App\Http\Resources\Operacoes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
         'id' => $this->id,
         'data_digitacao',
         'data_finalizacao',
        ];
    }
}
