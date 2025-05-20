@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Produto x Fornecedor')
@section('content_header')
    <h1>Cadastro de Fornecedor</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('fornecedor.produto.create', ['idFornecedor' => $idFornecedor]) }}" class="btn button-dalpra mb-3"><b>Novo Vínculo de Produto</b></a>
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
                    <th class="col-5">Descrição</th>
                    <th class="col-1">Tipo de Produto</th>
                    <th class="col-2">Custo</th>
                    <th class="col-2">Preço de Venda</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td class="col-5">{{ $produto?->produto->descricao }}</td>
                        <td class="col-1">{{ $produto?->produto->tipo_produto == 1 ? 'Produto' : 'Serviço' }}</td>
                        <td class="col-2">{{ number_format($produto->custo, 2, ',', '.') }}</td>
                        <td class="col-2">{{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar" href="{{ route('fornecedor.produto.show', ['idFornecedor' => $idFornecedor, 'id' => $produto->id, 'str' => 'V']) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('fornecedor.produto.edit', ['idFornecedor' => $idFornecedor, 'id' => $produto->id]) }}" class="btn btn-outline-primary">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a title="Excluir" href="{{ route('fornecedor.produto.show', ['idFornecedor' => $idFornecedor, 'id' => $produto->id, 'str' => 'R']) }}" class="btn btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1">
                {{ $produtos->links('pagination::bootstrap-5', ['locale' => 'pt-BR']) }}
            </div>
        </div>
    </div>

@endsection

