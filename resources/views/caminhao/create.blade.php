@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Cadastrar Caminhão')

@section('content_header')
    <h1>Cadastrar Caminhão</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('caminhao.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}" required>
                </div>

                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" class="form-control" value="{{ old('placa') }}">
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('caminhao.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
