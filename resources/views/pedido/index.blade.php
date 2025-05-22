@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Caminhões')
@section('content_header')
    <h1>Cadastro de Caminhões</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('pedido.create') }}" class="btn button-dalpra mb-3"><b>Novo Pedido</b></a>
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
                    <th class="col-2">ID</th>
                    <th class="col-5">Cliente</th>
                    <th class="col-3">Valor</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="col-2">{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="col-5">{{ $pedido->clientes ? $pedido->clientes->nome : 'N/A' }}</td>
                        <td class="col-3">{{ 'R$ ' . number_format($pedido->valor, 2, ',', '.') }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar"  href="{{ route('pedido.show', ['id' => $pedido->id, 'str' => 'V']) }}" class="btn btn-outline-info move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('pedido.edit', $pedido) }}" class="btn btn-outline-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a title="Excluir"  href="{{ route('pedido.show', ['id' => $pedido->id, 'str' => 'R']) }}" class="btn btn-outline-danger move">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1">
                {{ $pedidos->links('pagination::bootstrap-5', ['locale' => 'pt-BR']) }}
            </div>
        </div>
    </div>

@endsection

