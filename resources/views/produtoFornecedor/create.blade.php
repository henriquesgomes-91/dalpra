@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#valor').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        });
    </script>
@endpush
@section('title', 'Novo Produto x Fornecedor')

@section('content_header')
    <h1>Criar Produto x Fornecedor</h1>
@endsection

@section('content')
    <form action="{{ route('produtofornecedor.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_fornecedor">Fornecedor</label>
            <select name="id_fornecedor" class="form-control" required>
                @foreach($fornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_produto">Produto</label>
            <select name="id_produto" class="form-control" required>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" name="valor" id="valor" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
