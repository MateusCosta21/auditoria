<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao_ponto' => 'required|array',
            'descricao_orientacao' => 'required|array',
            'descricao_acao_realizada' => 'required|array',
            'descricao_acao_sugestiva' => 'required|array',
            'descricao_acao_complementar' => 'required|array',
            'imagem.*.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da auditoria é obrigatório.',
            'descricao_ponto.required' => 'A descrição do ponto auditado é obrigatória.',
            'descricao_orientacao.required' => 'A descrição da orientação é obrigatória.',
            'descricao_acao_realizada.required' => 'A descrição da ação realizada é obrigatória.',
            'descricao_acao_sugestiva.required' => 'A descrição da ação sugestiva é obrigatória.',
            'descricao_acao_complementar.required' => 'A descrição da ação complementar é obrigatória.',
            'imagem.*.*.image' => 'Cada arquivo deve ser uma imagem.',
            'imagem.*.*.mimes' => 'A imagem deve ser do tipo jpg, jpeg, png ou gif.',
            'imagem.*.*.max' => 'A imagem não pode ter mais de 2MB.',
        ];
    }
}
