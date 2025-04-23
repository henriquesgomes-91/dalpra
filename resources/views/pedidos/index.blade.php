@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush

@section('title', 'Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
    <a href="{{ route('pedidos.create') }}" class="btn button-dalpra mb-3"><b>Novo Pedido</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Fornecedor</th>
            <th>Produto</th>
            <th>Valor</th>
            <th>Data de Entrega</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->clientes ? $pedido->clientes->nome : 'N/A' }}</td>
                <td>{{ $pedido->fornecedor ? $pedido->fornecedor->razao_social : 'N/A'}}</td>
                <td>{{ $pedido->produtos->descricao }}</td>
                <td>{{ 'R$ ' . number_format($pedido->valor, 2, ',', '.') }}</td>
                <td>{{ $pedido->data_entrega ? date('d/m/Y', strtotime($pedido->data_entrega)) : 'N/A' }}</td>
                <td>
                    <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
