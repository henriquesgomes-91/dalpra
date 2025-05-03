@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Relatório de Vendas')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_relatorio_entregas').DataTable({
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "zeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "emptyTable": "Nenhum registro encontrado.",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ],
                order : [[ 5, "asc" ]]
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Relatório de Vendas</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_relatorio_entregas" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-3">Cliente</th>
                    <th class="col-2">Produto</th>
                    <th class="col-1">Quantidade (em mt³)</th>
                    <th class="col-2">Fornecedor</th>
                    <th class="col-2">Motorista</th>
                    <th class="col-1">Data de Entrega</th>
                    <th class="col-1">Valor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="col-3">{{$pedido?->pedidos?->clientes ? $pedido->pedidos->clientes->nome : 'N/A'}}</td>
                        <td class="col-2">{{ $pedido?->produtos?->descricao ?? 'N/A' }}</td>
                        <td class="col-1">{{ $pedido->quantidade  }}</td>
                        <td class="col-2">{{$pedido->fornecedor ? $pedido->fornecedor->razao_social : 'N/A'}}</td>
                        <td class="col-2">{{ $pedido?->entregas?->motoristas ? $pedido?->entregas?->motoristas?->nome : 'N/A' }}</td>
                        <td class="col-1">{{$pedido->data_entrega ? date('d/m/Y', strtotime($pedido->data_entrega)) : 'N/A'}}</td>
                        <td class="col-1">{{'R$ '.number_format($pedido->valor, 2, ',', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-9" colspan="6"><b>Valor Total </b></td>
                        <td class="col-3"><b>{{ 'R$ '.number_format($pedidos->sum('valor'), 2, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <div class="col-6 text-left">
                <h3></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-6 text-left">
                <a href="{{ route('relatorio.entregas.exportar') }}" class="btn btn-success mb-3">Exportar para Excel</a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('relatorio.entregas') }}" class="btn btn-secondary mb-3">Voltar</a>
            </div>
        </div>

        <br><br>
    </div>
@endsection
