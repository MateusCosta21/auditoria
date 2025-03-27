<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Services\Clientes\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(protected ClienteService $service)
    {
        
    }
    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request)
    {
        $auditoria = $this->service->criarCliente($request->all());

        return redirect()->route('auditorias.index')->with('success', 'Cliente criado com sucesso!');
    }
}
