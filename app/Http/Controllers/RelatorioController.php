<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarPDF($id)
    {
        $auditoria = Auditoria::with(['itens', 'itens.imagens'])->findOrFail($id);
    
        $setoresComItens = [];
        $setorAtual = null;
        $itensDoSetor = [];
    
        foreach ($auditoria->itens as $item) {
            if ($item->tipo == 'Setor' && $item->ordem == 0) {
                if ($setorAtual !== null) {
                    $setoresComItens[] = [
                        'setor' => $setorAtual,
                        'itens' => $itensDoSetor
                    ];
                }
    
                $setorAtual = $item;
                $itensDoSetor = [];
            } else {
                // Adiciona caminho absoluto das imagens aqui
                $item->imagens->map(function ($imagem) {
                    $imagem->caminho_absoluto = public_path('storage/' . $imagem->caminho_imagem);
                    return $imagem;
                });
    
                $itensDoSetor[] = $item;
            }
        }
    
        if ($setorAtual !== null) {
            $setoresComItens[] = [
                'setor' => $setorAtual,
                'itens' => $itensDoSetor
            ];
        }
    
        $pdf = PDF::loadView('relatorios.auditoria', compact('auditoria', 'setoresComItens'));
    
        return $pdf->stream("Relatorio_Auditoria_{$auditoria->id}.pdf");
    }
    
}
