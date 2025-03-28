<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Auditoria</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .titulo { text-align: center; font-size: 18px; font-weight: bold; }
        .info { margin-top: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 6px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .section { margin-top: 20px; }
        .anexos img { width: 100px; height: auto; margin: 5px; }
    </style>
</head>
<body>
    <div class="titulo">RELATÓRIO DE AUDITORIA</div>
    
    <div class="info">
        <p><strong>Cliente:</strong> {{ $auditoria->cliente->nome ?? 'Não informado' }}</p>
        <p><strong>Data do Relatório:</strong> {{ $auditoria->data ?? 'Não informado' }}</p>
        <p><strong>Responsável:</strong> {{ $auditoria->user->name ?? 'Não informado' }}</p>
    </div>
    
    @foreach ($setoresComItens as $setorItem)
        <div class="section">
            <h3>Setor: {{ $setorItem['setor']->descricao }}</h3>
            <table class="table">
                <tr>
                    <th>Pontos Auditados</th>
                    <th>Orientação Realizada</th>
                    <th>Ação Realizada</th>
                    <th>Ação Sugestiva</th>
                    <th>Ação Complementar</th>
                    <th>Prazo Estabelecido</th>
                </tr>
                <tr>
                    @foreach ($setorItem['itens'] as $item)
                        <td>{{ $item->descricao ?? 'N/A' }}</td>
                    @endforeach
                </tr>
            </table>
        </div>
    @endforeach

</body>
</html>
