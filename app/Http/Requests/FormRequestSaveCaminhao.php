<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestSaveCaminhao extends FormRequest
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
            'descricao' => 'required|string|max:50',
            'placa' => 'required|string|max:8',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição precisa ser um texto válido.',
            'descricao.max' => 'O campo descrição pode ter no máximo 50 caracteres.',

            'placa.required' => 'O campo placa é obrigatório.',
            'placa.string' => 'O campo placa precisa ser um texto válido.',
            'placa.max' => 'O campo placa pode ter no máximo 8 caracteres.',
        ];
    }
}
