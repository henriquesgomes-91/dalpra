@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Produtos x Fornecedores - ' . $produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A')

@section('content_header')
    <h1>Visualizar Produtos x Fornecedores - {{$produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A'}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Fornecedor:</label>
        <p>{{ $produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A' }}</p>
    </div>
    <div class="form-group">
        <label>Produto:</label>
        <p>{{ $produtoxfornecedor->produto->descricao }}</p>
    </div>
    <div class="form-group">
        <label>Valor:</label>
        <p>{{ 'R$ ' . number_format($produtoxfornecedor->valor, 2, ',', '.') }}</p>
    </div>
    <a href="{{ route('produtofornecedor.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
