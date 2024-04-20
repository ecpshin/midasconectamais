<?php

namespace App\Http\Requests\Filtros;

use Illuminate\Foundation\Http\FormRequest;

class FiltraLigacoesRequest extends FormRequest
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
            'inicio' => 'required|date|date_format:Y-m-d|before:final',
            'final' => 'required|date|date_format:Y-m-d|after_or_equal:inicio',
            'user_id' => 'required|integer'
        ];
    }

    public function attributes(): array
    {
        return [
            'inicio' => 'Data inicial',
            'final' => 'Data final',
            'user_id' => 'Agente'
        ];
    }

    public function messages(): array
    {
        return [
            'date' => 'Data inválida',
            'before' => 'O :attribute deve vir antes que a data final',
            'after_or_equal' => 'O :attribute não pode vir antes que a data inicial',
            'integer' => 'Agente inválido!',
            'required' => 'O Campo :attribute é obrigatório!',
        ];
    }
}
