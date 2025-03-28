<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'id_cliente' => 'required|integer|exists:clientes,id',
            'setor_nome' => 'required|array|min:1',
            'setor_nome.*' => 'required|string|max:255',
    
            // Ponto Auditado
            'descricao_ponto' => 'required|array|min:1',
            'descricao_ponto.*.*' => 'required|string',
    
            // Orientação Realizada
            'descricao_orientacao' => 'required|array',
            'descricao_orientacao.*.*' => 'required|string',
    
            // Ação Realizada (AGORA OBRIGATÓRIA)
            'descricao_acao_realizada' => 'required|array',
            'descricao_acao_realizada.*.*' => 'required|string',
    
            // Ação Sugestiva
            'descricao_acao_sugestiva' => 'nullable|array',
            'descricao_acao_sugestiva.*.*' => 'nullable|string',
    
            // Ação Complementar
            'descricao_acao_complementar' => 'nullable|array',
            'descricao_acao_complementar.*.*' => 'nullable|string',
    
            // Datas
            'realizada_em' => 'nullable|array',
            'realizada_em.*.*' => 'nullable|date',
            'prazo_estabelecido' => 'nullable|array',
            'prazo_estabelecido.*.*' => 'nullable|date',
    
            // Validação das imagens
            'imagem' => 'nullable|array',
            'imagem.*.*' => 'nullable|array',
            'imagem.*.*.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB máx
        ];
    }
    
   
}
