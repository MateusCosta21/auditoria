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
            'imagem.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);
        $descricao = implode("\n", $request->descricao_ponto); 
     
        $auditoria = Auditoria::create([
            'nome' => $request->nome,
            'user_id' => auth()->user()->id
        ]);

        $item = ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ponto Auditado',
            'descricao' => $descricao, 
            'ordem' => 1,  
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Orientação Realizada',
            'descricao' => $descricao,
            'ordem' => 2,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Realizada',
            'descricao' => $descricao,
            'ordem' => 3,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Sugestiva',
            'descricao' => $descricao,
            'ordem' => 4,
        ]);

        ItemAuditoria::create([
            'auditoria_id' => $auditoria->id,
            'tipo' => 'Ação Complementar',
            'descricao' => $descricao,
            'ordem' => 5,
        ]);

        if ($request->has('imagem')) {
            foreach ($request->imagem as $index => $imagem) {
                $path = $imagem->store('auditorias/imagens');
                ImagensItemAuditoria::create([
                    'item_auditoria_id' => $item->id, 
                    'caminho_imagem' => $path,
                ]);
            }
        }
        return redirect()->route('auditorias.index', $auditoria->id)->with('success', 'Auditoria criada com sucesso!');
    }
}