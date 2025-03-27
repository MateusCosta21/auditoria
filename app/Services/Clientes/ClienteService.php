<?php

namespace App\Services\Clientes;

use App\Repositories\ClienteRepository;

class ClienteService{

    public function __construct(protected ClienteRepository $repository)
    {
        
    }

    public function obterAuditoriasPaginadas($perPage = 10)
    {
        return $this->repository->listarAuditoriasPaginadas($perPage);
    }
    
    public function criarCliente(array $dados){
        return $this->repository->salvar($dados);
    }
}