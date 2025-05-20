@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Fornecedor')
@section('content_header')
    <h1>Cadastro de Fornecedor</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('fornecedor.create') }}" class="btn button-dalpra mb-3"><b>Novo Fornecedor</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-5">Razão Social</th>
                    <th class="col-5">CNPJ</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fornecedores as $fornecedor)
                    <tr>
                        <td class="col-5">{{ $fornecedor->razao_social }}</td>
                        <td class="col-5">{{ substr($fornecedor->cnpj, 0, 2) . '.' . substr($fornecedor->cnpj, 2, 3) . '.' . substr($fornecedor->cnpj, 5, 3) . '/' . substr($fornecedor->cnpj, 8, 4) . '-' . substr($fornecedor->cnpj, 12, 2) }}</td>
                        <td class="col-2 text-center">
                            <a title="Cadastrar Produtos"  href="{{ route('fornecedor.produto.index', ['idFornecedor' => $fornecedor->id]) }}" class="btn btn-outline-light move">
                                <i class="fas fa-wrench"></i>
                            </a>
                            <a title="Visualizar"  href="{{ route('fornecedor.show', ['id' => $fornecedor->id, 'str' => 'V']) }}" class="btn btn-outline-info move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('fornecedor.edit', $fornecedor) }}" class="btn btn-outline-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a title="Excluir"  href="{{ route('fornecedor.show', ['id' => $fornecedor->id, 'str' => 'R']) }}" class="btn btn-outline-danger move">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1">
                {{ $fornecedores->links('pagination::bootstrap-5', ['locale' => 'pt-BR']) }}
            </div>
        </div>
    </div>

@endsection

