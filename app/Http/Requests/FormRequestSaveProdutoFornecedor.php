<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormRequestSaveProdutoFornecedor extends FormRequest
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
            'custo' => str_replace(['R$', ' '], '', $this->custo ?? 0),
            'preco_venda' => str_replace(['R$', ' '], '', $this->preco_venda)
        ]);

        $this->merge([
            'custo' => str_replace(['.', ','],['', '.'],$this->custo ?? 0),
            'preco_venda' => str_replace(['.', ','],['', '.'],$this->preco_venda)
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
            'id_fornecedor' => 'required|exists:fornecedor,id',
            'id_produto' => [
                'required',
                'exists:produtos,id',
                Rule::unique('produto_fornecedor')
                    ->whereNull('deleted_at')
                    ->where('id_fornecedor', $this->idFornecedor)
            ],
            'custo' => 'required|numeric',
            'preco_venda' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id_fornecedor.required' => 'O campo fornecedor é obrigatório.',
            'id_fornecedor.exists' => 'O fornecedor selecionado não existe.',

            'id_produto.required' => 'O campo produto é obrigatório.',
            'id_produto.exists' => 'O produto selecionado não existe.',
            'id_produto.unique' => 'Este produto ja foi cadastrado para esse fornecedor.',

            'custo.required' => 'O campo custo é obrigatório.',
            'custo.string' => 'O campo custo precisa ser um numero válido.',

            'preco_venda.required' => 'O campo preço de venda é obrigatório.',
            'preco_venda.string' => 'O campo preço de venda precisa ser um número válido.',
        ];
    }
}
