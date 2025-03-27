<?php

namespace App\Repositories;

use App\Models\ItemAuditoria;

class ItemAuditoriaRepository
{

    public function __construct(protected ItemAuditoria $model) {}

    public function salvar(array $dados) {
        return $this->model->create($dados);
    }
}
