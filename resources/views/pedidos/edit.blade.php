@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush

@section('title', 'Editar Pedido')

@section('content_header')
    <h1>Editar Pedido</h1>
@endsection

@section('content')
    <form action="{{ route('pedido.update', $pedido) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente" class="form-control">
                <option value="">Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                    <
