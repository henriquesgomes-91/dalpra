@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Caminhão')

@section('content_header')
    <h1>Caminhão</h1>
@endsection

@section('content')
    <a href="{{ route('caminhao.create') }}" class="btn button-dalpra mb-3"><b>Novo Caminhão</b></a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Descrição</th>
            <th>Placa</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($caminhoes as $caminhao)
            <tr>
                <td>{{ $caminhao->descricao }}</td>
                <td>{{ $caminhao->placa }}</td>
                <td>
                    <a href="{{ route('caminhao.edit', $caminhao) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('caminhao.destroy', $caminhao) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $caminhoes->links() }}
@endsection
