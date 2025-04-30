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
            $('#tabela_relatorio_vendas').DataTable({
                'language': {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json'
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
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
            <table id="tabela_relatorio_vendas" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-3">ID</th>
                    <th class="col-2">Fornecedor</th>
                    <th class="col-2">Motorista</th>
                    <th class="col-2">Valor</th>
                    <th class="col-2">Data de Entrega</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="col-3">{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="col-2">{{$pedido->fornecedor ? $pedido->fornecedor->razao_social : 'N/A'}}</td>
                        <td class="col-2">{{ $pedido->motoristas ? $pedido->motoristas->nome : 'N/A' }}</td>
                        <td class="col-2">{{$pedido->data_entrega ? date('d/m/Y', strtotime($pedido->data_entrega)) : 'N/A'}}</td>
                        <td class="col-2">{{'R$ '.number_format($pedido->valor, 2, ',', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-9" colspan="4"><b>Valor Total </b></td>
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
                <a href="{{ route('relatorio.vendas.exportar') }}" class="btn btn-success mb-3">Exportar para Excel</a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('relatorio.vendas') }}" class="btn btn-secondary mb-3">Voltar</a>
            </div>
        </div>

        <br><br>
    </div>
@endsection
