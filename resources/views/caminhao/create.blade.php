@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Novo Caminhão')

@section('content_header')
    <h1>Novo Caminhão</h1>
@endsection

@section('content')
    <form action="{{ route('caminhao.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}" required>
        </div>

        <div class="form-group">
            <label>Placa</label>
            <input type="text" name="placa" class="form-control" value="{{ old('placa') }}">
        </div>

        <button type="submit" class="btn btn-success mt-2">Salvar</button>
        <a href="{{ route('caminhao.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
