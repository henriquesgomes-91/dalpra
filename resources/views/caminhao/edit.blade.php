@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Caminhão')

@section('content_header')
    <h1>Editar Caminhão</h1>
@endsection

@section('content')
    <form action="{{ route('caminhao.update', $caminhao) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Descriação</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $caminhao->descricao) }}" required>
        </div>

        <div class="form-group">
            <label>Placa</label>
            <input type="email" name="placa" class="form-control" value="{{ old('placa', $caminhao->placa) }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Atualizar</button>
        <a href="{{ route('caminhao.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
