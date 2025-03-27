@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cadastro de Clientes</h1>

        <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" required>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Cadastrar Cliente</button>
            </div>
        </form>
    </div>
@endsection
