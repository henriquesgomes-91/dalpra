@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Motorista - ' . $motorista->nome)

@section('content_header')
    <h1>Visualizar Motorista - {{$motorista->nome}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Nome:</label>
        <p>{{ $motorista->nome }}</p>
    </div>
    <div class="form-group">
        <label>Comissão:</label>
        <p>R$ {{ number_format($motorista->comissao,2 , ',', '.') }}</p>
    </div>
    <a href="{{ route('motorista.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
