@extends('layouts.pdf')

@section('content')
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .titulo { text-align: center; font-size: 16px; font-weight: bold; }
        .info { margin-top: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 6px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .section { margin-top: 20px; }
    </style>

    <div class="titulo">RELATÓRIO DE AUDITORIA</div>

    <div class="info">
        <p><strong>Cliente:</strong> {{ $auditoria->cliente ?? 'Não informado' }}</p>
        <p><strong>Data do Relatório:</strong> {{ $auditoria->data ?? 'Não informado' }}</p>
        <p><strong>Responsável:</strong> {{ $auditoria->user->name ?? 'Não informado' }}</p>
    </div>

    @foreach ($auditoria->setores as $setor)
        <div class="section">
            <h3>Setor: {{ $setor->nome }}</h3>
            <table class="table">
                <tr>
                    <th>Pontos Auditados</th>
                    <th>Orientação Realizada</th>
                    <th>Ação Realizada</th>
                    <th>Ação Sugestiva</th>
                    <th>Anotações</th>
                    <th>Ação Complementar</th>
                    <th>Prazo</th>
                </tr>
                @foreach ($setor->itens as $item)
                    <tr>
                        <td>{{ $item->descricao }}</td>
                        <td>{{ $item->orientacao ?? 'N/A' }}</td>
                        <td>{{ $item->acao_realizada ?? 'N/A' }}</td>
                        <td>{{ $item->acao_sugestiva ?? 'N/A' }}</td>
                        <td>{{ $item->anotacoes ?? 'N/A' }}</td>
                        <td>{{ $item->acao_complementar ?? 'N/A' }}</td>
                        <td>{{ $item->prazo ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach

    <div class="section">
        <h3>Anexos (Registros de auditoria)</h3>
        @foreach ($auditoria->imagens as $imagem)
            <img src="{{ public_path('storage/' . $imagem->caminho_imagem) }}" style="width: 100px; height: auto; margin: 5px;" alt="Anexo">
        @endforeach
    </div>
@endsection