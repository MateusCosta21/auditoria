<?php

namespace App\Repositories;

use App\Models\ImagensItemAuditoria;

class ImagemItemAuditoriaRepository
{

    public function __construct(protected ImagensItemAuditoria $model) {}

    public function salvar(array $dados) {
        return $this->model->create($dados);
    }
}
