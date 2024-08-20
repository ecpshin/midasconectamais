<?php

namespace App\Http\Resources\Comissoes;

use App\Http\Resources\Correspondentes\CorrespondentesResource;
use App\Http\Resources\Financeiras\FinanceirasResource;
use App\Http\Resources\Organizacoes\OrganizacoesResource;
use App\Http\Resources\Produtos\ProdutosResource;
use App\Models\Correspondente;
use App\Models\Financeira;
use App\Models\Organizacao;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TabelasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $produto = Produto::find($this->produto_id);
        $financeira = Financeira::find($this->financeira_id);
        $correspondente = Correspondente::find($this->correspondente_id);
        $organizacao = Organizacao::find($this->organizacao_id);

        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'codigo' => $this->codigo,
            'prazo' => $this->prazo,
            'produto' => ProdutosResource::make($produto),
            'financeira' => FinanceirasResource::make($financeira),
            'correspondente' => CorrespondentesResource::make($correspondente),
            'organizacao' => OrganizacoesResource::make($organizacao),
            'percentual_loja' => $this->percentual_loja,
            'percentual_agente' => $this->percentual_agente,
            'percentual_corretor' => $this->percentual_corretor,
            'parcelado' => $this->parcelado,
            'referencia' => $this->referencia
        ];;
    }
}
