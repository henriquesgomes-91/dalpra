@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Cliente - ' . $caminhao->descricao)

@section('content_header')
    <h1>Visualizar Cliente - {{$caminhao->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Descrição:</label>
        <p>{{ $caminhao->descricao }}</p>
    </div>
    <div class="form-group">
        <label>Placa:</label>
        <p>{{ $caminhao->placa }}</p>
    </div>
    <a href="{{ route('caminhao.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
