@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Cadastrar Produto')

@section('content_header')
    <h1>Cadastrar Produto</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('produto.store') }}" method="POST">
                @include('produto.form')
            </form>
        </div>
    </div>
@endsection
