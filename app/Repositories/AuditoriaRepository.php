<?php

namespace App\Repositories;

use App\Models\Auditoria;

class AuditoriaRepository
{

    public function __construct(protected Auditoria $modelAuditoria) {}

    public function salvar(array $dados) {
        return $this->modelAuditoria->create($dados);
    }
}
