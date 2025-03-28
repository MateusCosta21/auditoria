<?php

namespace App\Services\Auditorias;

use App\Repositories\ItemAuditoriaRepository;
use App\Repositories\ImagemItemAuditoriaRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;


class ItemAuditoriaService
{


    public function __construct(protected ItemAuditoriaRepository $itemAuditoriaRepository,
                                protected ImagemItemAuditoriaRepository $imagemItemAuditoriaRepository) {
    }

    public function criarItensAuditoria(int $auditoriaId, array $dados, array $imagens = [])
{
    foreach ($dados['setor_nome'] as $setorIndex => $setorNome) {
        // Salvar o setor
        $setor = $this->itemAuditoriaRepository->salvar([
            'auditoria_id' => $auditoriaId,
            'tipo' => 'Setor',
            'descricao' => $setorNome,
            'ordem' => 0,
        ]);

        // Procurar o índice correto dentro de 'descricao_ponto'
        $realIndex = array_keys($dados['descricao_ponto'])[$setorIndex] ?? null;

        if ($realIndex !== null && isset($dados['descricao_ponto'][$realIndex])) {
            foreach ($dados['descricao_ponto'][$realIndex] as $pontoIndex => $descricao) {
                $ponto = $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Ponto Auditado',
                    'descricao' => $descricao,
                    'ordem' => 1,
                ]);

                $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Orientação Realizada',
                    'descricao' => $dados['descricao_orientacao'][$realIndex][$pontoIndex] ?? '',
                    'ordem' => 2,
                ]);

                $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Ação Realizada',
                    'descricao' => $dados['descricao_acao_realizada'][$realIndex][$pontoIndex] ?? '',
                    'ordem' => 3,
                ]);

                $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Ação Sugestiva',
                    'descricao' => $dados['descricao_acao_sugestiva'][$realIndex][$pontoIndex] ?? '',
                    'ordem' => 4,
                ]);

                $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Ação Complementar',
                    'descricao' => $dados['descricao_acao_complementar'][$realIndex][$pontoIndex] ?? '',
                    'ordem' => 5,
                ]);

                $this->itemAuditoriaRepository->salvar([
                    'auditoria_id' => $auditoriaId,
                    'tipo' => 'Prazo Estabelecido',
                    'descricao' => $dados['prazo_estabelecido'][$realIndex][$pontoIndex] ?? '',
                    'ordem' => 6,
                ]);

                if (!empty($imagens[$realIndex][$pontoIndex])) {
                    foreach ($imagens[$realIndex][$pontoIndex] as $imagem) {
                        $this->salvarImagem($ponto->id, $imagem);
                    }
                }
            }
        }
    }
}
    
    
    
    
    
    private function salvarImagem(int $itemId, UploadedFile $imagem)
    {
        $path = $imagem->store('auditorias/imagens');
        $this->imagemItemAuditoriaRepository->salvar([
            'item_auditoria_id' => $itemId,
            'caminho_imagem' => $path,
        ]);
    }
}
