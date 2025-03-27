<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Auditoria</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .titulo { text-align: center; font-size: 18px; font-weight: bold; }
        .section { margin-top: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .image { width: 100px; height: auto; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1 class="titulo">Relatório de Auditoria</h1>
    <p><strong>Nome da Auditoria:</strong> {{ $auditoria->nome }}</p>
    <p><strong>Responsável:</strong> {{ $auditoria->user->name ?? 'Não informado' }}</p>

    @php
        $pontosAuditados = $auditoria->itens->where('tipo', 'Ponto Auditado');
    @endphp

    @foreach ($pontosAuditados as $ponto)
        <div class="section">
            <h2>Ponto Auditado {{ $loop->iteration }}</h2>
            <p><strong>Descrição:</strong> {{ $ponto->descricao }}</p>

            @php
                $orientacao = $auditoria->itens->where('tipo', 'Orientação Realizada')->where('ordem', 2)->firstWhere('auditoria_id', $auditoria->id);
                $acaoRealizada = $auditoria->itens->where('tipo', 'Ação Realizada')->where('ordem', 3)->firstWhere('auditoria_id', $auditoria->id);
                $acaoSugestiva = $auditoria->itens->where('tipo', 'Ação Sugestiva')->where('ordem', 4)->firstWhere('auditoria_id', $auditoria->id);
                $acaoComplementar = $auditoria->itens->where('tipo', 'Ação Complementar')->where('ordem', 5)->firstWhere('auditoria_id', $auditoria->id);
            @endphp

            <table class="table">
                <tr>
                    <th>Orientação Realizada</th>
                    <td>{{ $orientacao->descricao ?? 'Não informado' }}</td>
                </tr>
                <tr>
                    <th>Ação Realizada</th>
                    <td>{{ $acaoRealizada->descricao ?? 'Não informado' }}</td>
                </tr>
                <tr>
                    <th>Ação Sugestiva</th>
                    <td>{{ $acaoSugestiva->descricao ?? 'Não informado' }}</td>
                </tr>
                <tr>
                    <th>Ação Complementar</th>
                    <td>{{ $acaoComplementar->descricao ?? 'Não informado' }}</td>
                </tr>
            </table>

            @if ($ponto->imagens->count())
                <h3>Imagens:</h3>
                @foreach ($ponto->imagens as $imagem)
                    <img class="image" src="{{ public_path('storage/' . $imagem->caminho_imagem) }}" alt="Imagem do ponto auditado">
                @endforeach
            @endif
        </div>
    @endforeach

</div>

</body>
</html>
