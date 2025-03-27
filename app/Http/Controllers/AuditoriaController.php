<?php

namespace App\Http\Controllers;

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
            'imagem.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        // Criar nova auditoria
        $auditoria = Auditoria::create([
            'nome' => $request->nome,
            'usuario_id' => auth()->id(),
        ]);

        $item = ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ponto Auditado',
            'descricao' => $request->descricao_ponto, 
            'ordem' => 1,  
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Orientação Realizada',
            'descricao' => $request->descricao_orientacao,
            'ordem' => 2,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Realizada',
            'descricao' => $request->descricao_acao_realizada,
            'ordem' => 3,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Sugestiva',
            'descricao' => $request->descricao_acao_sugestiva,
            'ordem' => 4,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Complementar',
            'descricao' => $request->descricao_acao_complementar,
            'ordem' => 5,
        ]);

        if ($request->has('imagem')) {
            foreach ($request->imagem as $index => $imagem) {
                $path = $imagem->store('auditorias/imagens');
                ImagemItemAuditoria::create([
                    'item_auditoria_id' => $item->id, 
                    'caminho_imagem' => $path,
                ]);
            }
        }

        return redirect()->route('auditorias.show', $auditoria->id)->with('success', 'Auditoria criada com sucesso!');
    }
}