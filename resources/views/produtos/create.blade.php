@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Novo Produto')

@section('content_header')
    <h1>Criar Produto</h1>
@endsection

@section('content')
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
