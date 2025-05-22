
@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Pedido - ' . $pedido->descricao)

@section('content_header')
    <h1>Editar Pedido - {{$pedido->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('pedido.update', $pedido) }}" method="POST">
                @method('PUT')
                @include('pedido.form')
            </form>
        </div>
    </div>
@endsection
