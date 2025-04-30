@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Cliente - ' . $cliente->nome)

@section('content_header')
    <h1>Visualizar Cliente - {{$cliente->nome}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Nome:</label>
        <p>{{ $cliente->nome }}</p>
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <p>{{ $cliente->email }}</p>
    </div>
    <div class="form-group">
        <label>Telefone:</label>
        <p>{{ $cliente->telefone }}</p>
    </div>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
