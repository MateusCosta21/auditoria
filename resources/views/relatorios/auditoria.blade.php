<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Auditoria</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
            background-color: #f9f9f9;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid #004a99;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo img {
            height: 50px;
        }

        .titulo {
            font-size: 20px;
            font-weight: bold;
            color: #004a99;
            text-align: right;
            flex: 1;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 4px 0;
        }

        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .section h3 {
            background-color: #004a99;
            color: #fff;
            padding: 8px;
            border-radius: 4px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #e6eef7;
            color: #004a99;
        }

        .page-break {
            page-break-after: always;
        }

        .pagina-imagens {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 15px;
        }

        .pagina-imagens img {
            width: 200px;
            height: auto;
            border-radius: 4px;
            border: 1px solid #ccc;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="https://openquality.com.br/wp-content/uploads/2024/03/open-quality-logo.png" alt="Logo Open Quality">
        </div>
        <div class="titulo">RELATÓRIO DE AUDITORIA</div>
    </div>

    <div class="info">
        <p><strong>Cliente:</strong> {{ $auditoria->cliente->nome ?? 'Não informado' }}</p>
        <p><strong>Data do Relatório:</strong> {{ $auditoria->data ?? 'Não informado' }}</p>
        <p><strong>Responsável:</strong> {{ $auditoria->user->name ?? 'Não informado' }}</p>
    </div>

    @foreach ($setoresComItens as $setorItem)
    <div class="section">
        <h3>Setor: {{ $setorItem['setor']->descricao }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Ponto Auditado</th>
                    <th>Orientação Realizada</th>
                    <th>Realizada em</th>
                    <th>Ação Realizada</th>
                    <th>Ação Sugestiva</th>
                    <th>Ação Complementar</th>
                    <th>Prazo Estabelecido</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 0; @endphp
                <tr>
                    @foreach ($setorItem['itens'] as $item)
                        @php
                        $valor = $item->descricao ?? 'N/A';

                        if (in_array($contador % 7, [2, 6]) && $valor !== 'N/A') {
                            try {
                                $valor = \Carbon\Carbon::parse($valor)->format('d/m/Y');
                            } catch (\Exception $e) { }
                        }
                        @endphp
                        <td>{{ $valor }}</td>

                        @php $contador++; @endphp

                        @if ($contador % 7 === 0)
                            </tr><tr>
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Força quebra de página após cada tabela -->
    <div class="page-break"></div>

    <!-- Página separada exclusiva para imagens -->
    <div class="pagina-imagens">
        @foreach ($setorItem['itens'] as $item)
            @foreach ($item->imagens as $imagem)
                <img src="{{ $imagem->caminho_absoluto }}" alt="Imagem do item auditado">
            @endforeach
        @endforeach
    </div>
    @endforeach

</body>

</html>