
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
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $caminhao->descricao) }}" required>
                </div>

                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" class="form-control" value="{{ old('placa', $caminhao->placa) }}" required>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('caminhao.index') }}" class="btn btn-secondary mb-3">Voltar</a>
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
        <a href="{{ route('caminhao.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
