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
            'status_id' => $this->status_id,
            'produto_id' => $this->produto_id,
            'organizacao_id' => $this->organizacao_id,
            'data_ligacao' => $this->data_ligacao,
            'data_agendamento' => $this->data_agendamento,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'matricula' => $this->matricula,
            'orgao' => $this->orgao,
            'margem' => $this->margem,
            'telefone' => $this->telefone,
            'produto' => $this->produto,
            'user_id' => $this->user_id,
            'observacoes' => $this->observacoes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
