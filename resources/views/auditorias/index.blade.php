@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Auditorias Realizadas</h1>

    @if ($auditorias->isEmpty())
        <div class="alert alert-info">
            Nenhuma auditoria cadastrada ainda.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditorias as $index => $auditoria)
                        <tr>
                            <td>{{ $loop->iteration + ($auditorias->currentPage() - 1) * $auditorias->perPage() }}</td>
                            <td>{{ $auditoria->nome }}</td>
                            <td>{{ $auditoria->user->name ?? 'Desconhecido' }}</td>
                            <td>{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" disabled>Visualizar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $auditorias->links() }}
        </div>
    @endif
</div>
@endsection
