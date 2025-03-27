@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Auditorias Realizadas</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nome Cliente</th>
                    <th>Cnpj </th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditorias as $auditoria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $auditoria->nome }}</td>
                    <td>{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $auditoria->user->name ?? 'Desconhecido' }}</td>
                    <td>
                        <a href="{{ route('auditoria.pdf', $auditoria->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-file-pdf-o"></i> Baixar PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center mt-3">
        {{ $auditorias->links() }}
    </div>
</div>
@endsection
