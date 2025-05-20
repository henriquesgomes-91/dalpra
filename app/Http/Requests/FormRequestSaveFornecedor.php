<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestSaveFornecedor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj)
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'razao_social' => 'required|string|max:100',
            'cnpj' => 'required|string|max:15',
        ];
    }

    public function messages()
    {
        return [
            'razao_social.required' => 'O campo razão social é obrigatório.',
            'razao_social.string' => 'O campo razão social precisa ser um texto válido.',
            'razao_social.max' => 'O campo razão social pode ter no máximo 100 caracteres.',

            'cnpj.required' => 'O campo cnpj é obrigatório.',
            'cnpj.string' => 'O campo cnpj precisa ser um texto válido.',
            'cnpj.max' => 'O campo cnpj pode ter no máximo 15 caracteres.',
        ];
    }
}
