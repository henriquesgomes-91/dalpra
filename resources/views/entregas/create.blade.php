@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Cadastrar Cliente')

@section('content_header')
    <h1>Cadastrar Cliente</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}">
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
