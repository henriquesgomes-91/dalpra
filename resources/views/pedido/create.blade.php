@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Cadastrar Pedido')
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
                            if(data.tipo_pedido == 1) {
                                $("#preco").html("Preço de Venda");
                            } else {
                                $("#preco").html("Valor / Hora");
                            }

                            $("#unidade_medida").text("( em " + data.unidade_medida + " )");
                            $('#valor').maskMoney('mask');
                        }
                    });
                } else {
                    $('#valor').val(''); // Limpar o valor se nenhum produto for selecionado
                }
            });
            $('#cep')
                .mask('99.999-999', { placeholder: '__.___-___'})
                .on('blur', function () {
                    var idCep = $(this).attr('id');
                    $.getJSON("https://viacep.com.br/ws/"+$('#cep').val().replace('-', '').replace('.', '')+"/json/?callback=?")
                        .then((response) => {
                            if (!("erro" in response)) {
                                $('#logradouro').val(response.logradouro);
                                $('#bairro').val(response.bairro);
                                $('#cidade').val(response.localidade);
                                $('#estado').val(response.uf);
                            } else {
                                $('#cep').addClass('is-invalid')
                                if($('#cep').next().length == 0 ){
                                    $('#cep').parent().append('<span id="exampleInputEmail1-error" class="error invalid-feedback">CEP não encontrado</span>');
                                }
                            }

                        }).catch(error => {
                            $('#errorMessage').html('Consulta de CEP: ' + error);
                            $('#dialog-error').modal('show');
                    });
                });
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastrar Pedido</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('pedido.store') }}" method="POST">
                @include('pedido.form')
            </form>
        </div>
    </div>
@endsection
