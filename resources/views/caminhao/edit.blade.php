
@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Caminhão - ' . $caminhao->descricao)

@section('content_header')
    <h1>Editar Caminhão - {{$caminhao->descricao}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('caminhao.update', $caminhao) }}" method="POST">
                @method('PUT')
                @include('caminhao.form')
            </form>
        </div>
    </div>
@endsection
