@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Cadastrar Produto x Fornecedor')
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#preco_venda').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
            $('#custo').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });

            function updatePrecoLabel() {
                const selectedTipo = $('select[name="id_produto"]').find(':selected').data('tipo');

                if (selectedTipo === 1) {
                    $('#preco').text('Preço Venda');
                } else if (selectedTipo === 2) {
                    $('#preco').text('Valor / Hora');
                }
            }

            // Atualiza quando o select muda
            $('select[name="id_produto"]').on('change', function() {
                updatePrecoLabel();
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastrar Produto x Fornecedor</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('fornecedor.produto.store', ['idFornecedor' => $idFornecedor]) }}" method="POST">
                @include('fornecedor.produto.form')
            </form>
        </div>
    </div>
@endsection
