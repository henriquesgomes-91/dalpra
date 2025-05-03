@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Entrega - ' . $entrega->id)

@section('content_header')
    <h1>Visualizar Entrega - {{$entrega->id}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Motorista:</label>
        <p>{{ $entrega?->motoristas?->nome ?? 'N/A' }}</p>
    </div>
    <div class="form-group">
        <label>Caminhão:</label>
        <p>{{ $entrega?->caminhao?->descricao ?? 'N/A' }}</p>
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
                <td>{{date('d/m/Y', strtotime($item->entregas->data_entrega))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('entregas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
