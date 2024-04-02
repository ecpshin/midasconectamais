<?php

namespace App\Http\Requests\Operacoes;

use Illuminate\Foundation\Http\FormRequest;

class OperacoesStoreRequest extends FormRequest
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
            'descricao_operacao' => ['required', 'string', 'min:3', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'descricao_operacao' => 'Descrição da operação'
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
