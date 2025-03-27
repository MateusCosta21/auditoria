<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\ItemAuditoria;
use App\Models\ImagensItemAuditoria;
use Illuminate\Http\Request;


class AuditoriaController extends Controller
{
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
    
        $auditoria = Auditoria::create([
            'nome' => $request->nome,
            'user_id' => auth()->id()
        ]);
    
        foreach ($request->descricao_ponto as $index => $descricao) {
            $item = ItemAuditoria::create([
                'auditoria_id' => $auditoria->id,
                'tipo' => 'Ponto Auditado',
                'descricao' => $descricao,
                'ordem' => 1,
            ]);
    
            ItemAuditoria::create([
                'auditoria_id' => $auditoria->id,
                'tipo' => 'Orientação Realizada',
                'descricao' => $request->descricao_orientacao[$index] ?? '',
                'ordem' => 2,
            ]);
    
            ItemAuditoria::create([
                'auditoria_id' => $auditoria->id,
                'tipo' => 'Ação Realizada',
                'descricao' => $request->descricao_acao_realizada[$index] ?? '',
                'ordem' => 3,
            ]);
    
            ItemAuditoria::create([
                'auditoria_id' => $auditoria->id,
                'tipo' => 'Ação Sugestiva',
                'descricao' => $request->descricao_acao_sugestiva[$index] ?? '',
                'ordem' => 4,
            ]);
    
            ItemAuditoria::create([
                'auditoria_id' => $auditoria->id,
                'tipo' => 'Ação Complementar',
                'descricao' => $request->descricao_acao_complementar[$index] ?? '',
                'ordem' => 5,
            ]);
    
            // Verifica se há imagens enviadas para este ponto
            if ($request->hasFile("imagem.$index")) {
                foreach ($request->file("imagem.$index") as $imagem) {
                    $path = $imagem->store('auditorias/imagens');
                    ImagensItemAuditoria::create([
                        'item_auditoria_id' => $item->id,
                        'caminho_imagem' => $path,
                    ]);
                }
            }
        }
    
        return redirect()->route('auditorias.index')->with('success', 'Auditoria criada com sucesso!');
    }
    
}