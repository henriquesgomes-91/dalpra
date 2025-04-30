@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Produto - ' . $produto->descricao)

@section('content_header')
    <h1>Visualizar Produto - {{$produto->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Descrição:</label>
        <p>{{ $produto->descricao }}</p>
    </div>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
