<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestSavePedido extends FormRequest
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
            'cep' => preg_replace('/[^0-9]/', '', $this->cep)
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
            'id_cliente' => 'nullable|exists:clientes,id',
            'cep' => 'required|string|max:8',
            'logradouro' => 'required|string|max:100',
            'numero' => 'required|numeric',
            'complemento' => 'nullable|string|max:255',
            'referencia' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'fornecedores' => 'required|array',
            'produtos' => 'required|array',
            'quantidades' => 'required|array',
            'valores' => 'required|array',
            'fornecedores.*' => 'required|integer|exists:fornecedor,id',
            'produtos.*' => 'required|integer|exists:produtos,id',
            'quantidades.*' => 'required|numeric|min:0',
            'valores.*' => 'required|numeric|min:0',

            'id_fornecedor' => 'nullable',
            'id_produto' => 'nullable',
            'valor' => 'nullable',
            'quantidade' => 'nullable'

        ];
    }

    public function messages()
    {
        return [
            'id_cliente.exists' => 'O cliente selecionado não existe.',

            'cep.required' => 'O campo cep é obrigatório.',
            'cep.string' => 'O campo cep precisa ser um texto válido.',
            'cep.max' => 'O campo cep pode ter no máximo 8 caracteres.',

            'logradouro.required' => 'O campo logradouro é obrigatório.',
            'logradouro.string' => 'O campo logradouro precisa ser um texto válido.',
            'logradouro.max' => 'O campo logradouro pode ter no máximo 50 caracteres.',

            'numero.required' => 'O campo número é obrigatório.',
            'numero.numeric' => 'O campo número precisa ser um valor valido.',

            'complemento.string' => 'O campo complemento precisa ser um texto válido.',
            'complemento.max' => 'O campo complemento pode ter no máximo 255 caracteres.',

            'referencia.string' => 'O campo referência precisa ser um texto válido.',
            'referencia.max' => 'O campo referência pode ter no máximo 255 caracteres.',

            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro precisa ser um texto válido.',
            'bairro.max' => 'O campo bairro pode ter no máximo 100 caracteres.',

            'cidade.required' => 'O campo cidade é obrigatório.',
            'cidade.string' => 'O campo cidade precisa ser um texto válido.',
            'cidade.max' => 'O campo cidade pode ter no máximo 100 caracteres.',

            'estado.required' => 'O campo UF é obrigatório.',
            'estado.string' => 'O campo UF precisa ser um texto válido.',
            'estado.max' => 'O campo UF pode ter no máximo 2 caracteres.',

            'quantidades.required' => 'É necessário informar a quantidade.',
            'valores.required' => 'É necessário informar o valor.',
            'quantidades.*.min' => 'A quantidade não pode ser negativa.',
            'valores.*.min' => 'O valor não pode ser negativo.'
        ];
    }
}
