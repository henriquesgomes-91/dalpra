@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Relatório de Vendas')
@section('content')
    <div class="container">
        <h1>Relatório de Vendas</h1>

        <form action="{{ route('relatorio.vendas.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="data_inicio">Data Início:</label>
                <input type="date" name="data_inicio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data_fim">Data Fim:</label>
                <input type="date" name="data_fim" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pago">Pago?</label>
                <input type="checkbox" name="pago" value="1" id="pago">
            </div>
            <div class="form-group">
                <label for="fornecedor_id">Fornecedor:</label>
                <select name="fornecedor_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($fornecedores as $fornecedor)
                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="motorista_id">Motorista:</label>
                <select name="motorista_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($motoristas as $motorista)
                        <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
        </form>
    </div>
@endsection
