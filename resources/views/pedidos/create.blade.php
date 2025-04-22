@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@push('js')
    <script src="[https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>](https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>)
    <script>
        $(document).ready(function() {
            $('#id_fornecedor').change(function() {
                var fornecedorId = $(this).val();
                if (fornecedorId) {
                    $.ajax({
                        url: '/fornecedor/' + fornecedorId + '/produtos',
                        type: 'GET',
                        success: function(data) {
                            $('#id_produto').empty();
                            $('#id_produto').append('<option value="">Selecione o Produto</option>');
                            $.each(data, function(key, value) {
                                $('#id_produto').append('<option value="' + value.id + '">' + value.descricao + '</option>');
                            });
                        }
                    });
                } else {
                    $('#id_produto').empty();
                }
            });

            $('#id_produto').change(function() {
                var produtoId = $(this).val();
                if (produtoId) {
                    $.ajax({
                        url: '/produto/' + produtoId,
                        type: 'GET',
                        success: function(data) {
                            $('#valor').val(data.valor); // Preencher o valor do produto
                        }
                    });
                } else {
                    $('#valor').val(''); // Limpar o valor se nenhum produto for selecionado
                }
            });
        });
    </script>
@endpush
@section('title', 'Novo Pedido')

@section('content_header')
    <h1>Criar Pedido</h1>
@endsection

@section('content')
    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente" class="form-control">
                <option value="">Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" name="logradouro" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" name="numero" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text" name="complemento" class="form-control">
        </div>
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" required maxlength="2">
        </div>
        <div class="form-group">
            <label for="id_fornecedor">Fornecedor</label>
            <select name="id_fornecedor" id="id_fornecedor" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_produto">Produto</label>
            <select name="id_produto" id="id_produto" class="form-control" required>
                <!-- Os produtos serão carregados via JavaScript -->
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" class="form-control" value="" required step="0.01">
        </div>
        <div class="form-group">
            <label for="id_motorista">Motorista</label>
            <select name="id_motorista" id="id_motorista" class="form-control" required>
                @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_caminhao">Caminhão</label>
            <select name="id_caminhao" id="id_caminhao" class="form-control" required>
                @foreach($caminhoes as $caminhao)
                    <option value="{{ $caminhao->id }}">{{ $caminhao->modelo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pago">Pago</label>
            <input type="checkbox" name="pago" id="pago">
        </div>
        <div class="form-group">
            <label for="data_entrega">Data de Entrega</label>
            <input type="date" name="data_entrega" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
