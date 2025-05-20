<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestSaveMotorista extends FormRequest
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
            'comissao' => str_replace(['R$', ' '], '', $this->comissao)
        ]);

        $this->merge([
            'comissao' => str_replace(
                ['.', ','],
                ['', '.'],
                $this->comissao
            )
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
            'nome' => 'required|string|max:100',
            'comissao' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome precisa ser um texto válido.',
            'nome.max' => 'O campo nome pode ter no máximo 100 caracteres.',

            'comissao.required' => 'O campo comissao é obrigatório.',
            'comissao.numeric' => 'O campo comissao precisa ser um número válido.'
        ];
    }
}
