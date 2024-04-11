<?php

namespace App\Http\Requests\Ligacoes;

use Illuminate\Foundation\Http\FormRequest;

class LigacaoStoreRequest extends FormRequest
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
            'user_id' => ['nullable', 'integer'],
            'status_id' => ['required', 'integer'],
            'data_ligacao' => ['required', 'date'],
            'data_agendamento' => ['nullable', 'date'],
            'nome' => ['required', 'string', 'min:3', 'max:255'],
            'cpf' => ['required', 'string', 'min:11', 'max:14'],
            'matricula' => ['nullable', 'string'],
            'orgao' => ['nullable'],
            'margem' => ['nullable', 'numeric'],
            'telefone' => ['nullable', 'string'],
            'produto' => ['nullable', 'string'],
            'observacoes' => ['nullable', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Usuário',
            'status_id' => 'Status',
            'data_ligacao' => 'Data da ligação',
            'data_agendamento' => 'Data do agendamento',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'matricula' => 'Matrícula',
            'orgao' => 'Órgão',
            'margem' => 'Margem',
            'telefone' => 'Telefone',
            'produto' => 'Produto',
            'observacoes' => 'Observações'
        ];
    }

    public function messages(): array
    {
        return [
            'date' => 'O campo :attribute deve ser uma data válida.',
            'integer' => 'O campo :attribute inválido.',
            'min' => 'O campo deve conter no mínimo :min caracteres.',
            'max' => 'O campo deve  conter no máximo :max caracteres.',
            'numeric' => 'O campo :attribute deve conter valor numérico.',
            'required' =>  'Campo de preenchimento obrigatório',
            'string' => 'O campo deve conter uma string.',
        ];
    }
}
