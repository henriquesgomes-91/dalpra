@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Entrega')

@section('content_header')
    <h1>Editar Entrega</h1>
    <hr class="hr-dalpra">
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pedido').change(function() {
                var pedidoId = $(this).val();
                if (pedidoId) {
                    $.ajax({
                        url: '/pedido/' + pedidoId + '/itens', // Ajuste a URL conforme necessário
                        type: 'GET',
                        success: function(data) {
                            var itensTableBody = $('#itens-table tbody');

                            $.each(data.itens, function(index, item) {
                                let numeroFormatado = item.valor.toLocaleString('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                                itensTableBody.append(`
                            <tr>
                                <td>${item.fornecedor.razao_social}</td>
                                <td>${item.produtos.descricao}</td>
                                <td>${item.quantidade}</td>
                                <td>${numeroFormatado}</td>
                                <td>
                                    <input type="checkbox" name="itens[${item.id}][pago]" ${item.pago ? 'checked' : ''}>
                                </td>
                                <td>
                                    <input type="date" name="itens[${item.id}][data_entrega]" value="${item.data_entrega}">
                                </td>
                            </tr>
                        `);
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('entregas.update', $entrega->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="id_motorista">Motorista</label>
                    <select name="id_motorista" id="id_motorista" class="form-control">
                        <option value="">Selecione um Motorista</option>
                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}" {{$entrega->id_motorista == $motorista->id ? 'selected' : ''}}>{{ $motorista->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_caminhao">Caminhão</label>
                    <select name="id_caminhao" id="id_caminhao" class="form-control">
                        <option value="">Selecione um Caminhão</option>
                        @foreach($caminhoes as $caminhao)
                            <option value="{{ $caminhao->id }}" {{$entrega->id_caminhao == $caminhao->id ? 'selected' : ''}}>{{ $caminhao->descricao }} / {{ $caminhao->placa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pedido">Pedido</label>
                    <select id="pedido" class="form-control">
                        <option value="">Selecione um Pedido</option>
                        @foreach($pedidos as $pedido)
                            <option value="{{ $pedido->id }}">{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</option>
                        @endforeach
                    </select>
                </div>


                <table class="table" id="itens-table">
                    <thead>
                    <tr>
                        <th>Fornecedor</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Pago</th>
                        <th>Data de Entrega</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($itensPedido as $item)
                            <tr>
                                <td>{{$item->fornecedor->razao_social}}</td>
                                <td>{{$item->produtos->descricao}}</td>
                                <td>{{$item->quantidade}}</td>
                                <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                                <td>{{$item->pago ? 'Sim' : 'Nao'}}</td>
                                <td>{{date('d/m/Y', strtotime($item->data_entrega))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('entregas.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
