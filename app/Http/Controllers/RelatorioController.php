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

        // Alterado para o caminho correto da view
        $pdf = PDF::loadView('relatorios.auditoria', compact('auditoria'));

        return $pdf->stream("Relatorio_Auditoria_{$auditoria->id}.pdf");
    }
}
