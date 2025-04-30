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
        <label>Fornecedor:</label>
        <p>{{$pedido->fornecedor ? $pedido->fornecedor->razao_social : 'N/A'}}</p>
    </div>
    <div class="form-group">
        <label>Produto:</label>
        <p>{{$pedido->produtos->descricao}}</p>
    </div>
    <div class="form-group">
        <label>Valor:</label>
        <p>{{'R$ '.number_format($pedido->valor, 2, ',', '.')}}</p>
    </div>
    <div class="form-group">
        <label>Motorista:</label>
        <p>{{$pedido->motoristas ? $pedido->motoristas->nome : 'N/A'}}</p>
    </div>
    <div class="form-group">
        <label>Caminhão:</label>
        <p>{{$pedido->caminhao ? $pedido->caminhao->descricao : 'N/A'}}</p>
    </div>
    <div class="form-group">
        <label>Pago:</label>
        <p>{{$pedido->pago ? 'Sim' : 'Nao'}}</p>
    </div>
    <div class="form-group">
        <label>Data de Entrega:</label>
        <p>{{$pedido->data_entrega ? date('d/m/Y', strtotime($pedido->data_entrega)) : 'N/A'}}</p>
    </div>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
