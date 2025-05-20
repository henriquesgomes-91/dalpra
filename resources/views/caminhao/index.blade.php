@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Caminhões')
@section('content_header')
    <h1>Cadastro de Caminhões</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('caminhao.create') }}" class="btn button-dalpra mb-3"><b>Novo Caminhão</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-5">Descrição</th>
                    <th class="col-5">Placa</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($caminhoes as $caminhao)
                    <tr>
                        <td class="col-5">{{ $caminhao->descricao }}</td>
                        <td class="col-5">{{ $caminhao->placa }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar"  href="{{ route('caminhao.show', ['id' => $caminhao->id, 'str' => 'V']) }}" class="btn btn-outline-info move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('caminhao.edit', $caminhao) }}" class="btn btn-outline-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a title="Excluir"  href="{{ route('caminhao.show', ['id' => $caminhao->id, 'str' => 'R']) }}" class="btn btn-outline-danger move">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1">
                {{ $caminhoes->links('pagination::bootstrap-5', ['locale' => 'pt-BR']) }}
            </div>
        </div>
    </div>

@endsection

