@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Produtos x Fornecedores')

@section('content_header')
    <h1>Produtos x Fornecedores</h1>
    <a href="{{ route('produtofornecedor.create') }}" class="btn button-dalpra mb-3"><b>Novo Produto x Fornecedor</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Fornecedor</th>
            <th>Produto</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produtosXFornecedores as $produtoxfornecedor)
            <tr>
                <td>{{ $produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A' }}</td>
                <td>{{ $produtoxfornecedor->produto->descricao }}</td>
                <td>{{ 'R$ ' . number_format($produtoxfornecedor->valor, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produtofornecedor.edit', $produtoxfornecedor) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('produtofornecedor.destroy', $produtoxfornecedor) }}" method="POST" style="display:inline;">
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
