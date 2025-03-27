<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditoriaRequest;
use App\Services\Auditorias\AuditoriaService;
use App\Services\Auditorias\ImagemItemAuditoriaService;
use App\Services\Auditorias\ItemAuditoriaService;
use Illuminate\Http\Request;


class AuditoriaController extends Controller
{
    public function __construct(
        protected AuditoriaService $auditoriaService,
        protected ItemAuditoriaService $itemService
    ) {}
    public function index()
    {
        $auditorias = $this->auditoriaService->obterAuditoriasPaginadas(10);
        return view('auditorias.index', compact('auditorias'));
    }

    public function create()
    {
        return view('auditorias.create');
    }

    public function store(StoreAuditoriaRequest $request)
    {
        $dadosAuditoria = [
            'nome' => $request->nome,
            'user_id' => auth()->id()
        ];

        $auditoria = $this->auditoriaService->criarAuditoria($dadosAuditoria);

        $this->itemService->criarItensAuditoria(
            $auditoria->id,
            $request->only([
                'descricao_ponto',
                'descricao_orientacao',
                'descricao_acao_realizada',
                'descricao_acao_sugestiva',
                'descricao_acao_complementar',
            ]),
            $request->file('imagem', [])
        );

        return redirect()->route('auditorias.index')->with('success', 'Auditoria criada com sucesso!');
    }
}
