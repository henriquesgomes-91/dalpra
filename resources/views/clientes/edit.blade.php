@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@endsection

@section('content')
    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone) }}">
        </div>

        <button type="submit" class="btn btn-success mt-2">Atualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
