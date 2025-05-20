<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestSaveProduto extends FormRequest
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
            'descricao' => 'required|string|max:100',
            'unidade_medida' => 'required',
            'tipo_produto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição precisa ser um texto válido.',
            'descricao.max' => 'O campo descrição pode ter no máximo 100 caracteres.',

            'unidade_medida.required' => 'O campo unidade de medida é obrigatório.',

            'tipo_produto.required' => 'O campo tipo de produto é obrigatório.',
        ];
    }
}
