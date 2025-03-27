<?php

namespace App\Services\Auditorias;

use App\Repositories\AuditoriaRepository;

class AuditoriaService{

    public function __construct(protected AuditoriaRepository $auditoriaRepository)
    {
        
    }

    public function criarAuditoria(array $dados){
        return $this->auditoriaRepository->salvar($dados);
    }
}