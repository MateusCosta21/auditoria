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

            <div class="mb-4">
                <label for="nome" class="form-label">Nome da Auditoria</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div id="pontos-container">
                <div class="ponto-section" id="ponto-1">
                    <h3>Ponto Auditado #1</h3>

                    <div class="mb-4">
                        <label for="descricao_ponto_1" class="form-label">Descrição do Ponto a ser Auditado</label>
                        <textarea name="descricao_ponto[]" id="descricao_ponto_1" class="form-control" rows="3" required></textarea>
                    </div>

                    <h4>Orientação Realizada</h4>
                    <div class="mb-4">
                        <textarea name="descricao_orientacao[]" class="form-control" rows="3" required></textarea>
                    </div>

                    <h4>Ação Realizada</h4>
                    <div class="mb-4">
                        <textarea name="descricao_acao_realizada[]" class="form-control" rows="3" required></textarea>
                    </div>

                    <h4>Ação Sugestiva</h4>
                    <div class="mb-4">
                        <textarea name="descricao_acao_sugestiva[]" class="form-control" rows="3" required></textarea>
                    </div>

                    <h4>Ação Complementar</h4>
                    <div class="mb-4">
                        <textarea name="descricao_acao_complementar[]" class="form-control" rows="3" required></textarea>
                    </div>

                    <h4>Adicionar Imagens</h4>
                    <div class="mb-4">
                        <input type="file" name="imagem[]" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-ponto-btn">Adicionar Novo Ponto</button>
            <br><br>

            <button type="submit" class="btn btn-primary">Iniciar Auditoria</button>
        </form>
    </div>

    <script>
        let pontoCount = 1;

        document.getElementById('add-ponto-btn').addEventListener('click', function() {
    pontoCount++;

    // Clonar a primeira seção de ponto
    const pontoSection = document.getElementById('ponto-1').cloneNode(true);
    pontoSection.id = 'ponto-' + pontoCount;

    // Limpar os campos do novo ponto
    pontoSection.querySelectorAll('textarea').forEach((textarea) => {
        textarea.value = '';  // Limpa o conteúdo
        textarea.id = textarea.id.replace(/\d+/, pontoCount);
        textarea.name = textarea.name.replace(/\[\d+\]/, '[' + (pontoCount - 1) + ']');
    });

    pontoSection.querySelectorAll('input[type="file"]').forEach((input) => {
        input.value = '';  // Reseta o campo de arquivo
        input.name = 'imagem[' + (pontoCount - 1) + '][]';  // Atualiza o nome do campo de imagem corretamente
    });

    // Atualiza o título do ponto
    pontoSection.querySelector('h3').textContent = 'Ponto Auditado #' + pontoCount;

    // Adicionar o novo ponto à lista
    document.getElementById('pontos-container').appendChild(pontoSection);
});
    </script>
@endsection
