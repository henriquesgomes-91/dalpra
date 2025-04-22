@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cnpj').mask('00.000.000/0000-00');
        });
    </script>
@endpush
@section('title', 'Novo Fornecedor')

@section('content_header')
    <h1>Criar Fornecedor</h1>
@endsection

@section('content')
    <form action="{{ route('fornecedor.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" name="razao_social" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection
