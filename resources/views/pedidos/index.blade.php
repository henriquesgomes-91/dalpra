@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Pedidos')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_pedidos').DataTable({
                'language': {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json'
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ],
                order : [[ 0, "desc" ]]
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastro de Pedidos</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('pedidos.create') }}" class="btn button-dalpra mb-3"><b>Novo Pedido</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_pedidos" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-2">Cliente</th>
                    <th class="col-3">Fornecedor</th>
                    <th class="col-2">Produto</th>
                    <th class="col-1">Valor</th>
                    <th class="col-1">Data de Entrega</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="col-1">{{ $pedido->id }}</td>
                        <td class="col-2">{{ $pedido->clientes ? $pedido->clientes->nome : 'N/A' }}</td>
                        <td class="col-3">{{ $pedido->fornecedor ? $pedido->fornecedor->razao_social : 'N/A' }}</td>
                        <td class="col-2">{{ $pedido->produtos ? $pedido->produtos->descricao : 'N/A' }}</td>
                        <td class="col-1">{{ 'R$ ' . number_format($pedido->valor, 2, ',', '.') }}</td>
                        <td class="col-1">{{ $pedido->data_entrega ? date('d/m/Y', strtotime($pedido->data_entrega)) : 'N/A' }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar" href="{{ route('pedidos.show', $pedido) }}" class="btn btn-outline-dark move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button title="Excluir" class="btn btn-danger move" onclick="return confirm('Tem certeza?')">
                                    <i class="fas fa-trash"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
