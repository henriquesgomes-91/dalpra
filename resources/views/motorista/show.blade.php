@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', $isDelete ? 'Excluir Motorista' : 'Visualizar Motorista' . ' - ' . $motorista->nome)

@section('content_header')
    <h1>{{$isDelete ? 'Excluir Motorista' : 'Visualizar Motorista'}} - {{$motorista->nome}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if($isDelete)
        <div class="row table-responsive">
            <div class="col-12">
                <form action="{{ route('motorista.destroy', $motorista) }}" method="POST">
                    @method('DELETE')
                    @include('motorista.form')
                </form>
            </div>
        </div>
    @else
        <div class="form-group">
            <label>Nome:</label>
            <p>{{ $motorista->nome }}</p>
        </div>
        <div class="form-group">
            <label>Comissão:</label>
            <p>R$ {{ number_format($motorista->comissao,2 , ',', '.') }}</p>
        </div>
        <a href="{{ route('motorista.index') }}" class="btn btn-secondary">Voltar</a>
    @endif
@endsection
