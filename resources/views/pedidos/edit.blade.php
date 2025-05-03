@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Pedido - ' . $pedido->id)

@section('content_header')
    <h1>Editar Pedido - {{$pedido->id}}</h1>
    <hr class="hr-dalpra">
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#valor').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });

            $('#save-item').click(function() {
                const fornecedorId = $('#id_fornecedor').val();
                const produtoId = $('#id_produto').val();
                const quantidade = $('#quantidade').val();
                const valor = $('#valor').val().replace('R$ ', '').replace('.', '').replace(',', '.');

                if (fornecedorId && produtoId && valor && quantidade) {
                    const fornecedorText = $('#id_fornecedor option:selected').text();
                    const produtoText = $('#id_produto option:selected').text();
                    let numeroFormatado = valor.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    const newRow = `
                    <tr>
                        <td>${fornecedorText}</td>
                        <td>${produtoText}</td>
                        <td>${quantidade}</td>
                        <td>R$ ${numeroFormatado}</td>
                        <td>
                            <input type="hidden" name="fornecedores[]" value="${fornecedorId}">
                            <input type="hidden" name="produtos[]" value="${produtoId}">
                            <input type="hidden" name="quantidades[]" value="${quantidade}">
                            <input type="hidden" name="valores[]" value="${valor}">
                            <button type="button" class="btn btn-danger remove-item">Remover</button>
                        </td>
                    </tr>
                `;

                    $('#itens-container').append(newRow);
                    $('.fecharModal').trigger('click'); // Fecha a modal
                    $('#id_fornecedor').val('');
                    $('#id_produto').val('');
                    $('#quantidade').val('');
                    $('#valor').val('');
                } else {
                    alert('Por favor, preencha todos os campos.');
                }
            });

            $('#itens-container').on('click', '.remove-item', function() {
                $(this).closest('tr').remove();
            });

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
                var fornecedorId = $("#id_fornecedor").val();
                if (produtoId) {
                    $.ajax({
                        url: '/produto/' + fornecedorId + '/' + produtoId + '/preco',
                        type: 'GET',
                        success: function(data) {
                            $('#valor').val(data.preco_venda);
                            $('#valor').maskMoney('mask');
                        }
                    });
                } else {
                    $('#valor').val('');
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
            <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control">
                        <option value="">Selecione um Cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{$pedido->id_cliente == $cliente->id ? 'selected' : ''}}>{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro" class="form-control" value="{{$pedido->logradouro}}" required>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" class="form-control" value="{{$pedido->numero}}" required>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" value="{{$pedido->complemento}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" class="form-control" value="{{$pedido->bairro}}" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" class="form-control" value="{{$pedido->cidade}}" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" value="{{$pedido->estado}}" required maxlength="2">
                </div>


                <h3>Itens do Pedido</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemModal">Adicionar Item</button>

                <table class="table mt-3">
                    <thead>
                    <tr>
                        <th>Fornecedor</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="itens-container">
                    @if($pedido->itemPedido)
                        @foreach($pedido->itemPedido as $item)
                            <tr>
                                <td>{{$item->fornecedor->razao_social}}</td>
                                <td>{{$item->produtos->descricao}}</td>
                                <td>{{$item->quantidade ?? 0}}</td>
                                <td>{{'R$ '.number_format($item->valor, 2, ',', '.')}}</td>
                                <td>
                                    <input type="hidden" name="fornecedores[]" value="{{$item->id_fornecedor}}">
                                    <input type="hidden" name="produtos[]" value="{{$item->id_produto}}">
                                    <input type="hidden" name="quantidades[]" value="{{$item->quantidade ?? 0}}">
                                    <input type="hidden" name="valores[]" value="{{$item->valor}}">
                                    <button type="button" class="btn btn-danger remove-item">Remover</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- Itens adicionados aparecerão aqui -->
                    </tbody>
                </table>


                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Adicionar Item ao Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade (em mt³)</label>
                        <input type="number" name="quantidade" id="quantidade" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="valor">Preço de Venda</label>
                        <input type="text" name="valor" id="valor" class="form-control" value="" required step="0.01">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fecharModal" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="save-item">Salvar Item</button>
                </div>
            </div>
        </div>
    </div>
@endsection

