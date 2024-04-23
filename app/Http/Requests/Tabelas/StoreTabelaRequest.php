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
            'descricao' => 'required|string|min:3',
            'codigo' => 'required|string|min:3',
            'produto' => 'required|string|min:3',
            'percentual_loja' => 'nullable|decimal:0.000,100.000',
            'percentual_agente' => 'nullable|decimal:0.000,100.000',
            'percentual_corretor' => 'nullable|decimal:0.000,100.000',
            'financeira_id' => 'required|integer',
            'correspondente_id' => 'required|integer',
            'parcelado' => 'nullable|integer'
        ];
    }
}
