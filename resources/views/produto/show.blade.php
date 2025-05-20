@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Cliente - ' . $produto->descricao)

@section('content_header')
    <h1>Visualizar Cliente - {{$produto->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if($isDelete)
        <div class="row table-responsive">
            <div class="col-12">
                <form action="{{ route('produto.destroy', $produto) }}" method="POST">
                    @method('DELETE')
                    @include('produto.form')
                </form>
            </div>
        </div>
    @else
        <div class="form-group">
            <label>Descrição:</label>
            <p>{{ $produto->descricao }}</p>
        </div>
        <div class="form-group">
            <label>Unidade de Medida:</label>
            <p>{{ $produto->unidade_medida }}</p>
        </div>
        <div class="form-group">
            <label>Tipo de Produto:</label>
            <p>{{ $produto->tipo_produto == 1 ? 'Produto' : 'Serviço' }}</p>
        </div>
        <a href="{{ route('produto.index') }}" class="btn btn-secondary">Voltar</a>
    @endif
@endsection
