<?php

namespace App\Http\Requests\Correspondentes;

use Illuminate\Foundation\Http\FormRequest;

class CorrespondenteStoreRequest extends FormRequest
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
            'nome_correspondente' =>  ['required', 'string', 'max:255'],
            'nome_responsavel' =>  ['nullable', 'string', 'max:255'],
            'phone_contato' =>  ['nullable', 'string', 'max:25'],
            'cpf_cnpj' => ['nullable', 'string', 'max:25'],
        ];
    }

    public function messages(): array
    {
        return [
            'max' =>  'O campo deve ter no máximo :max caracteres.',
            'required' =>  'O campo deve ser preenchido.',
            'string' => 'O campo deve ser do tipo string',
        ];
    }
}
