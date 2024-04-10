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
            'oranizacao_id' => ['nullable', 'integer'],
            'data_ligacao' => ['required', 'date'],
            'data_agendamento' => ['required', 'date'],,
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
}
