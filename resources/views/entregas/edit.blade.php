
@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Cliente - ' . $cliente->nome)

@section('content_header')
    <h1>Editar Cliente - {{$cliente->nome}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone) }}">
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection



@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@endsection

@section('content')


        <button type="submit" class="btn btn-success mt-2">Atualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
