<?php

namespace App\Http\Requests\Produtos;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'descricao_produto' => ['required', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'descricao_produto' => 'Descrição do produto'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'string' => 'O campo :attribute é obrigatório.',
        ];
    }
}
