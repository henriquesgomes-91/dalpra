@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Produto x Fornecedor - ' . $produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A')

@section('content_header')
    <h1>Editar Produto x Fornecedor - {{$produtoxfornecedor->fornecedor ? $produtoxfornecedor->fornecedor->razao_social : 'N/A'}}</h1>
    <hr class="hr-dalpra">
@endsection
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
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('produtofornecedor.update', $produtoxfornecedor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id_fornecedor">Fornecedor</label>
                    <select name="id_fornecedor" class="form-control" required>
                        @foreach($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}" {{ $fornecedor->id == $produtoxfornecedor->id_fornecedor ? 'selected' : '' }}>
                                {{ $fornecedor->razao_social }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_produto">Produto</label>
                    <select name="id_produto" class="form-control" required>
                        @foreach($produtos as $produto)
                            <option value="{{ $produto->id }}" {{ $produto->id == $produtoxfornecedor->id_produto ? 'selected' : '' }}>
                                {{ $produto->descricao }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" name="valor" class="form-control" value="{{ $produtoxfornecedor->valor }}" step="0.01" required>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('produtofornecedor.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

