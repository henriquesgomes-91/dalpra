@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', $isDelete ? 'Excluir Fornecedor' : 'Visualizar Fornecedor' . ' - ' . $fornecedor->razao_social)

@section('content_header')
    <h1>{{$isDelete ? 'Excluir Fornecedor' : 'Visualizar Fornecedor'}} - {{$fornecedor->razao_social}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if($isDelete)
        <div class="row table-responsive">
            <div class="col-12">
                <form action="{{ route('fornecedor.destroy', $fornecedor) }}" method="POST">
                    @method('DELETE')
                    @include('fornecedor.form')
                </form>
            </div>
        </div>
    @else
        <div class="form-group">
            <label>Nome:</label>
            <p>{{ $fornecedor->razao_social }}</p>
        </div>
        <div class="form-group">
            <label>CNPJ:</label>
            <p>{{ substr($fornecedor->cnpj, 0, 2) . '.' . substr($fornecedor->cnpj, 2, 3) . '.' . substr($fornecedor->cnpj, 5, 3) . '/' . substr($fornecedor->cnpj, 8, 4) . '-' . substr($fornecedor->cnpj, 12, 2) }}</p>
        </div>
        <a href="{{ route('fornecedor.index') }}" class="btn btn-secondary">Voltar</a>
    @endif
@endsection
