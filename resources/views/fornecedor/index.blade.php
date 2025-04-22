@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Fornecedores')

@section('content_header')
    <h1>Fornecedores</h1>
    <a href="{{ route('fornecedor.create') }}" class="btn button-dalpra mb-3"><b>Novo Fornecedor</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->razao_social }}</td>
                <td>{{ substr($fornecedor->cnpj, 0, 2) . '.' . substr($fornecedor->cnpj, 2, 3) . '.' . substr($fornecedor->cnpj, 5, 3) . '/' . substr($fornecedor->cnpj, 8, 4) . '-' . substr($fornecedor->cnpj, 12, 2) }}</td>
                <td>
                    <a href="{{ route('fornecedor.edit', $fornecedor) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('fornecedor.destroy', $fornecedor) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection@extends('adminlte::page')

@section('title', 'Novo Fornecedor')

@section('content_header')
    <h1>Criar Fornecedor</h1>
@endsection

@section('content')
    <form action="{{ route('fornecedor.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" name="razao_social" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
