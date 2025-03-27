<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{

    public function __construct(protected Cliente $model) {}

    public function salvar(array $dados) {
        return $this->model->create($dados);
    }

    public function listarAuditoriasPaginadas($perPage = 10)
    {
        return $this->model::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
