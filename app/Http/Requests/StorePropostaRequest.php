<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropostaRequest extends FormRequest
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
          'uuid' => 'nullable|string',
          'numero_contrato' => 'nullable|string|min:3|max:50',
          'data_digitacao' => 'required|date',
          'data_pagamento' => 'nullable|date',
          'prazo_proposta' => 'nullable|integer',
          'total_proposta' => 'nullable|numeric',
          'parcela_proposta' => 'nullable|numeric',
          'liquido_proposta' => 'nullable|numeric',
          'percentual_loja' => 'nullable|numeric',
          'valor_loja' => 'nullable|numeric',
          'percentual_agente' => 'nullable|numeric',
          'valor_agente' => 'nullable|numeric',
          'percentual_corretor' => 'nullable|numeric',
          'valor_corretor' => 'nullable|numeric',
          'cliente_id' => 'required|integer',
          'tabela_id' => 'required|integer',
          'produto_id' => 'required|integer',
          'financeira_id' => 'required|integer',
          'correspondente_id' => 'required|integer',
          'situacao_id' => 'required|integer',
          'user_id' => 'nullable|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'uuid' => 'uuid',
            'numero_contrato' => 'Nº Contrato ou ADE',
            'data_digitacao' => 'Data da digitação',
            'data_pagamento' => 'Data de pagamento',
            'prazo_proposta' => 'Prazo da proposta',
            'total_proposta' => 'Total da proposta',
            'parcela_proposta' => 'Valor da parcela',
            'liquido_proposta' => 'Valor líquido',
            'percentual_loja' => 'Percentual Loja',
            'valor_loja' => 'Valor loja',
            'percentual_agente' => 'Percentual agente',
            'valor_agente' => 'Valor agente',
            'percentual_corretor' => 'Percentual corretor',
            'valor_corretor' => 'valor corretor',
            'cliente_id' => 'Cliente',
            'tabela_id' => 'Tabela comissão',
            'produto_id' => 'Produto',
            'financeira_id' => 'Financeira',
            'correspondente_id' => 'Correspondente',
            'situacao_id' => 'Situação',
            'user_id' => 'Usuário',
        ];
    }

    public function messages(): array
    {
        return [
          'date' => 'O campo :attribute deve ser uma data válida.',
          'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
          'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
          'integer' => 'O campo :attribute não é válido.',
          'numeric' => 'O campo :attribute não é um número válido.',
          'required' => 'O campo :attribute é obrigatório.',
          'string' => 'O campo :attribute deve ser uma string.',
        ];
    }
}
