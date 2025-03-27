@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Iniciar Nova Auditoria</h1>

        <form action="{{ route('auditorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                        <input type="file" name="imagem[{{ 0 }}][]" class="form-control" multiple>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-ponto-btn">Adicionar Novo Ponto</button>
            <br><br>

            <button type="submit" class="btn btn-primary">Iniciar Auditoria</button>
        </form>
    </div>

    <script>
        let pontoCount = 1;  // Começa com um ponto auditado

        document.getElementById('add-ponto-btn').addEventListener('click', function() {
            pontoCount++;

            // Clonar a primeira seção de ponto
            const pontoSection = document.getElementById('ponto-1').cloneNode(true);
            pontoSection.id = 'ponto-' + pontoCount;  // Atualizar o ID para o novo ponto

            // Atualizar os IDs e os nomes dos inputs para refletirem o novo número do ponto
            pontoSection.querySelectorAll('textarea').forEach((textarea, index) => {
                textarea.id = textarea.id.replace('1', pontoCount);  // Atualiza o id
                textarea.name = textarea.name.replace('[]', '[' + (pontoCount - 1) + ']');  // Atualiza o nome
            });

            pontoSection.querySelectorAll('input[type="file"]').forEach((input, index) => {
                input.name = input.name.replace('[]', '[' + (pontoCount - 1) + ']');  // Atualiza o nome
            });

            // Atualiza o título do ponto
            const pontoTitle = pontoSection.querySelector('h3');
            pontoTitle.innerHTML = 'Ponto Auditado #' + pontoCount;

            // Adicionar o novo ponto à lista de pontos
            document.getElementById('pontos-container').appendChild(pontoSection);
        });
    </script>
@endsection
