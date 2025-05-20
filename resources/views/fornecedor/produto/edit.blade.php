@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Fornecedor - ' . $fornecedor->razao_social)
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00');
        });
    </script>
@endpush
@section('content_header')
    <h1>Editar Fornecedor - {{$fornecedor->razao_social}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('fornecedor.update', $fornecedor) }}" method="POST">
                @method('PUT')
                @include('fornecedor.form')
            </form>
        </div>
    </div>
@endsection
