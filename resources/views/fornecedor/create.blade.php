@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Cadastrar Fornecedor')
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00');
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastrar Fornecedor</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('fornecedor.store') }}" method="POST">
                @include('fornecedor.form')
            </form>
        </div>
    </div>
@endsection
