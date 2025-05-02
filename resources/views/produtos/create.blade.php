@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Cadastrar Produtos')

@section('content_header')
    <h1>Cadastrar Produtos</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="unidade_medida">Unidade de Medida</label>
                    <select name="unidade_medida" id="unidade_medida" class="form-control" required>
                        <option value="UN">UN</option>
                        <option value="KG">KG</option>
                        <option value="MT">MT</option>
                        <option value="MT3">MT³</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

