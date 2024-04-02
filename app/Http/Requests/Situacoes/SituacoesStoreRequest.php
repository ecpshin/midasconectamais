<?php

namespace App\Http\Requests\Situacoes;

use Illuminate\Foundation\Http\FormRequest;

class SituacoesStoreRequest extends FormRequest
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
        return ['descricao_situacao' => ['required', 'string', 'max:255', 'min:3']];
    }

    public function attributes(): array
    {
        return ['descricao_situacao' => 'Descrição Situacão'];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrogatório',
            'string' => 'O campo :attribute deve ser uma string',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres'
        ];
    }
}
