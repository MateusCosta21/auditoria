<?php

namespace App\Services\Auditorias;

use App\Repositories\ItemAuditoriaRepository;
use App\Repositories\ImagemItemAuditoriaRepository;
use Illuminate\Http\UploadedFile;

class ItemAuditoriaService
{


    public function __construct(protected ItemAuditoriaRepository $itemAuditoriaRepository,
                                protected ImagemItemAuditoriaRepository $imagemItemAuditoriaRepository) {
    }

    public function criarItensAuditoria(int $auditoriaId, array $dados, array $imagens = [])
    {
        foreach ($dados['descricao_ponto'] as $index => $descricao) {
            $item = $this->itemAuditoriaRepository->salvar([
                'auditoria_id' => $auditoriaId,
                'tipo' => 'Ponto Auditado',
                'descricao' => $descricao,
                'ordem' => 1,
            ]);

            $this->itemAuditoriaRepository->salvar([
                'auditoria_id' => $auditoriaId,
                'tipo' => 'Orientação Realizada',
                'descricao' => $dados['descricao_orientacao'][$index] ?? '',
                'ordem' => 2,
            ]);

            $this->itemAuditoriaRepository->salvar([
                'auditoria_id' => $auditoriaId,
                'tipo' => 'Ação Realizada',
                'descricao' => $dados['descricao_acao_realizada'][$index] ?? '',
                'ordem' => 3,
            ]);

            $this->itemAuditoriaRepository->salvar([
                'auditoria_id' => $auditoriaId,
                'tipo' => 'Ação Sugestiva',
                'descricao' => $dados['descricao_acao_sugestiva'][$index] ?? '',
                'ordem' => 4,
            ]);

            $this->itemAuditoriaRepository->salvar([
                'auditoria_id' => $auditoriaId,
                'tipo' => 'Ação Complementar',
                'descricao' => $dados['descricao_acao_complementar'][$index] ?? '',
                'ordem' => 5,
            ]);

            if (!empty($imagens[$index])) {
                foreach ($imagens[$index] as $imagem) {
                    $this->salvarImagem($item->id, $imagem);
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
