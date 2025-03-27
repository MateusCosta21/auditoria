<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do cliente é obrigatório.',
            'cnpj.required' => 'O cnpj é obrigatório.',

        ];
    }
}
