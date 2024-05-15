<?php

namespace App\Http\Requests\Tabelas;

use Illuminate\Foundation\Http\FormRequest;

class StoreTabelaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produto_id' => 'required|integer',
            'financeira_id' => 'required|integer',
            'correspondente_id' => 'required|integer',
            'organizacao_id' => 'required|integer',
            'descricao' => 'required|string|min:3',
            'codigo' => 'required|string|min:3',
            'percentual_loja' => 'nullable|decimal:0.00,100.00',
            'percentual_diferido' => 'nullable|decimal:0.00,100.00',
            'percentual_agente' => 'nullable|decimal:0.00,100.00',
            'percentual_corretor' => 'nullable|decimal:0.00,100.00',
            'prazo' => 'nullable|integer',
            'parcelado' => 'nullable|integer',
            'referencia' => 'nullable|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'produto_id' => 'Produto',
            'financeira_id' => 'Financeira',
            'correspondente_id' => 'Correspondente',
            'organizacao_id' => 'Órgão',
            'descricao' => 'Descrição da Tabela',
            'codigo' => 'Código da tabela',
            'percentual_loja' => 'Percentual loja',
            'percentual_diferido' => 'Percentual diferido',
            'percentual_agente' => 'Percentual agente',
            'percentual_corretor' => 'Percentual corretor',
            'prazo' => 'Prazo',
            'parcelado' => 'gera parcela',
            'referencia' => 'referência de cálculo'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser do tipo string.',
            'integer' => 'O campo :attribute não é válido',
            'decimal' => 'O campo :attribute deve ser um número entre 0,00 e 100,00',
        ];
    }
}
