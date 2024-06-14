<?php

namespace App\Http\Requests\Clientes;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
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
            'nome' => 'required',
            'cpf' => 'required|string|unique:clientes,cpf',
            'data_nascimento' => 'nullable|date',
            'rg' => 'nullable|string|min:3',
            'orgao_exp' => 'nullable|string|min:3|max:50',
            'data_exp' => 'nullable|date',
            'naturalidade' => 'nullable|string|min:3|max:100',
            'genitora' => 'nullable|string|min:3|max:100',
            'genitor' => 'nullable|string|min:3|max:100',
            'sexo' => 'nullable|string|min:3|max:50',
            'estado_civil' => 'nullable|string|min:3|max:50',
            'phone1' => 'nullable|string|min:3|max:50',
            'phone2' => 'nullable|string|min:3|max:50',
            'phone3' => 'nullable|string|min:3|max:50',
            'phone4' => 'nullable|string|min:3|max:50',
            'user_id' => 'nullable|integer',
            'files' => 'nullable|array',
            'files.*' => 'bail|mimes:jpeg,jpg,png,pdf|max:' . (1024 * 10)
        ];
    }

    public function attributes(): array
    {
        return [
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'data_nascimento' => 'Data de nascimento',
            'rg' => 'RG',
            'orgao_exp' => 'Órgão expedidor',
            'data_exp' => 'Data de expedição',
            'naturalidade' => 'Naturalidade',
            'genitora' => 'Nome da mãe',
            'genitor' => 'Nome do pai',
            'sexo' => 'Sexo',
            'estado_civil' => 'Estado Civil',
            'user_id' => 'ID do Agente',
        ];
    }

    public function messages(): array
    {
        return [
            'date' => 'Forneça uma data válida.',
            'integer' => 'O campo agente dever fo tipo inteiro.',
            'max' => 'O campo deve ter no máximo :max caracteres.',
            'min' => 'O campo deve ter no mínimo :min caracteres.',
            'required' => 'O campo é ser preenchido.',
            'string' => 'O campo deve ser do tipo string',
            'unique' => 'Já existe um registro com este :attribute'
        ];
    }
}
