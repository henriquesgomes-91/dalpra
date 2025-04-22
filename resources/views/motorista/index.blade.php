@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Motoristas')

@section('content_header')
    <h1>Motoristas</h1>
    <a href="{{ route('motorista.create') }}" class="btn button-dalpra mb-3"><b>Novo Motorista</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($motoristas as $motorista)
            <tr>
                <td>{{ $motorista->nome }}</td>
                <td>
                    <a href="{{ route('motorista.edit', $motorista) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('motorista.destroy', $motorista) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
