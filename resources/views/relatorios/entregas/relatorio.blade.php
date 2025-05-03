@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Relatório de Entregas')
@section('content')
    <div class="container">
        <h1>Relatório de Entregas</h1>

        <form action="{{ route('relatorio.entregas.generate') }}" method="POST">
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
                <input type="radio" name="pago" value="1" id="naoPago"><label for="naoPago">&nbsp;Não Pago</label>
                &nbsp;&nbsp;<input type="radio" name="pago" value="0" id="pago"><label for="pago">&nbsp;Pago</label>
                &nbsp;&nbsp;<input type="radio" name="pago" value="2" id="todos"><label for="todos">&nbsp;Todos</label>
            </div>
            <div class="form-group">
                <label for="produto_id">Produto:</label>
                <select name="produto_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                    @endforeach
                </select>
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
            <div class="form-group">
                <label for="caminhao_id">Caminhão:</label>
                <select name="caminhao_id" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($caminhoes as $caminhao)
                        <option value="{{ $caminhao->id }}">{{ $caminhao->descricao }} / {{ $caminhao->placa }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
        </form>
    </div>
@endsection
