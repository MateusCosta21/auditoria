<?php

namespace App\Repositories;

use App\Models\Auditoria;

class AuditoriaRepository
{

    public function __construct(protected Auditoria $modelAuditoria) {}

    public function salvar(array $dados) {
        return $this->modelAuditoria->create($dados);
    }

    public function listarAuditoriasPaginadas($perPage = 10)
    {
        return $this->modelAuditoria::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
