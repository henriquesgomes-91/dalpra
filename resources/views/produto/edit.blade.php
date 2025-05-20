
@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Produto - ' . $produto->descricao)

@section('content_header')
    <h1>Editar Produto - {{$produto->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('produto.update', $produto) }}" method="POST">
                @method('PUT')
                @include('produto.form')
            </form>
        </div>
    </div>
@endsection
