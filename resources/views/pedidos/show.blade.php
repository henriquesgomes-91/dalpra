@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Visualizar Pedido - ' . $pedido->id)

@section('content_header')
    <h1>Visualizar Pedido - {{$pedido->id}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    <div class="form-group">
        <label>Cliente:</label>
        <p>{{ $pedido->clientes ? $pedido->clientes->nome : 'N/A' }}</p>
    </div>
    <div class="form-group">
        <label>Logradouro:</label>
        <p>{{$pedido->logradouro}}</p>
    </div>
    <div class="form-group">
        <label>Número:</label>
        <p>{{$pedido->numero}}</p>
    </div>
    <div class="form-group">
        <label>Complemento:</label>
        <p>{{$pedido->complemento}}</p>
    </div>
    <div class="form-group">
        <label>Bairro:</label>
        <p>{{$pedido->bairro}}</p>
    </div>
    <div class="form-group">
        <label>Cidade:</label>
        <p>{{$pedido->cidade}}</p>
    </div>
    <div class="form-group">
        <label>Estado:</label>
        <p>{{$pedido->estado}}</p>
    </div>
    <div class="form-group">
        <label>Valor:</label>
        <p>{{'R$ '.number_format($pedido->valor, 2, ',', '.')}}</p>
    </div>

    <h3>Itens do Pedido</h3>
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Fornecedor</th>
            <th>Produto</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody id="itens-container">
        @if($pedido->itemPedido)
            @foreach($pedido->itemPedido as $item)
                <tr>
                    <td>{{$item->fornecedor->razao_social}}</td>
                    <td>{{$item->produtos->descricao}}</td>
                    <td>{{'R$ '.number_format($item->valor, 2, ',', '.')}}</td>
                    <td>
                        <input type="hidden" name="fornecedores[]" value="{{$item->id_fornecedor}}">
                        <input type="hidden" name="produtos[]" value="{{$item->id_produto}}">
                        <input type="hidden" name="valores[]" value="{{$item->valor}}">
                    </td>
                </tr>
            @endforeach
        @endif
        <!-- Itens adicionados aparecerão aqui -->
        </tbody>
    </table>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
