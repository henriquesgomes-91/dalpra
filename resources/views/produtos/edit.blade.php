@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto</h1>
@endsection

@section('content')
    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ $produto->descricao }}" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
@endsection
