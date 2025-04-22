@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Produto x Fornecedor')

@section('content_header')
    <h1>Editar Produto x Fornecedor</h1>
@endsection

@section('content')
    <form action="{{ route('produtofornecedor.update', $produtoxfornecedor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_fornecedor">Fornecedor</label>
            <select name="id_fornecedor" class="form-control" required>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" {{ $fornecedor->id == $produtoxfornecedor->id_fornecedor ? 'selected' : '' }}>
                        {{ $fornecedor->razao_social }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_produto">Produto</label>
            <select name="id_produto" class="form-control" required>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" {{ $produto->id == $produtoxfornecedor->id_produto ? 'selected' : '' }}>
                        {{ $produto->descricao }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" name="valor" class="form-control" value="{{ $produtoxfornecedor->valor }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
@endsection
