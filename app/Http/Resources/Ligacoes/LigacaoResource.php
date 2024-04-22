<?php

namespace App\Http\Resources\Ligacoes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LigacaoResource extends JsonResource
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
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'data_ligacao' => $this->data_ligacao,
            'data_agendamento' => $this->data_agendamento,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'matricula' => $this->matricula,
            'orgao' => $this->orgao,
            'margem' => $this->margem,
            'telefone' => $this->telefone,
            'produto' => $this->produto,
            'observacoes' => $this->observacoes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
