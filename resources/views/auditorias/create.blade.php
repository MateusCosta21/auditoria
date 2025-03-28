@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Iniciar Nova Auditoria</h1>

    <form action="{{ route('auditorias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="nome" class="form-label">Nome da Auditoria</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <button type="button" class="btn btn-secondary" id="add-setor-btn">Adicionar Setor</button>

        <div id="setores-container"></div>

        <br><br>

        <button type="submit" class="btn btn-primary">Iniciar Auditoria</button>
    </form>
</div>

<script>
    let setorCount = 0;
    let pontoCount = 0;

    document.getElementById('add-setor-btn').addEventListener('click', function () {
        setorCount++;

        const setorDiv = document.createElement('div');
        setorDiv.classList.add('setor-section', 'mt-4', 'p-3', 'border', 'rounded');
        setorDiv.id = 'setor-' + setorCount;

        setorDiv.innerHTML = `
            <h3>Setor #${setorCount}</h3>
            <div class="mb-3">
                <label for="setor_nome_${setorCount}" class="form-label">Nome do Setor</label>
                <input type="text" name="setor_nome[]" id="setor_nome_${setorCount}" class="form-control" required>
            </div>
            <button type="button" class="btn btn-info add-ponto-btn" data-setor="${setorCount}">Adicionar Ponto Auditado</button>
            <div id="pontos-container-${setorCount}" class="mt-3"></div>
        `;

        document.getElementById('setores-container').appendChild(setorDiv);
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-ponto-btn')) {
            pontoCount++;
            const setorId = event.target.getAttribute('data-setor');
            const pontosContainer = document.getElementById('pontos-container-' + setorId);

            const pontoDiv = document.createElement('div');
            pontoDiv.classList.add('ponto-section', 'mt-3', 'p-3', 'border', 'rounded');
            pontoDiv.id = `ponto-${pontoCount}`;

            pontoDiv.innerHTML = `
                <h4>Ponto Auditado #${pontoCount}</h4>
                <div class="mb-3">
                    <label for="descricao_ponto_${pontoCount}" class="form-label">Descrição do Ponto Auditado</label>
                    <textarea name="descricao_ponto[${setorId}][]" id="descricao_ponto_${pontoCount}" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Orientação Realizada</label>
                    <textarea name="descricao_orientacao[${setorId}][]" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Realizada em</label>
                    <input type="date" name="realizada_em[${setorId}][]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ação Realizada</label>
                    <textarea name="descricao_acao_realizada[${setorId}][]" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ação Sugerida</label>
                    <textarea name="descricao_acao_sugestiva[${setorId}][]" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Anotações Complementares</label>
                    <textarea name="descricao_acao_complementar[${setorId}][]" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prazo Estabelecido</label>
                    <input type="date" name="prazo_estabelecido[${setorId}][]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adicionar Imagens</label>
                    <input type="file" name="imagem[${setorId}][${pontoCount}][]" class="form-control" multiple>
                </div>
            `;

            pontosContainer.appendChild(pontoDiv);
        }
    });
</script>

@endsection
