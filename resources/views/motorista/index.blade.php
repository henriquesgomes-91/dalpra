@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Motorista')
@section('content_header')
    <h1>Cadastro de Motorista</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('motorista.create') }}" class="btn button-dalpra mb-3"><b>Novo Motorista</b></a>
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
                    <th class="col-5">Nome</th>
                    <th class="col-5">Comissão</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($motoristas as $motorista)
                    <tr>
                        <td class="col-5">{{ $motorista->nome }}</td>
                        <td class="col-5">R$ {{ number_format($motorista->comissao,2 , ',', '.') }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar"  href="{{ route('motorista.show', ['id' => $motorista->id, 'str' => 'V']) }}" class="btn btn-outline-info move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('motorista.edit', $motorista) }}" class="btn btn-outline-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a title="Excluir"  href="{{ route('motorista.show', ['id' => $motorista->id, 'str' => 'R']) }}" class="btn btn-outline-danger move">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-1">
                {{ $motoristas->links('pagination::bootstrap-5', ['locale' => 'pt-BR']) }}
            </div>
        </div>
    </div>

@endsection

