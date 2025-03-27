<?php

namespace App\Http\Controllers;

use App\Services\Auditorias\AuditoriaService;
use App\Services\Auditorias\ImagemItemAuditoriaService;
use App\Services\Auditorias\ItemAuditoriaService;
use Illuminate\Http\Request;


class AuditoriaController extends Controller
{
    public function __construct(protected AuditoriaService $auditoriaService, 
                                protected ItemAuditoriaService $itemService, 
                                protected ImagemItemAuditoriaService $imagemService){}
    public function index()
    {
        return view('auditorias.index');
    }

    public function create()
    {
        return view('auditorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao_ponto' => 'required|array',
            'descricao_orientacao' => 'required|array',
            'descricao_acao_realizada' => 'required|array',
            'descricao_acao_sugestiva' => 'required|array',
            'descricao_acao_complementar' => 'required|array',
            'imagem.*.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
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