@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Motoristas')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_motoristas').DataTable({
                'language': {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json'
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastro de Motoristas</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('motorista.create') }}" class="btn button-dalpra mb-3"><b>Novo Motorista</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_motoristas" class="table table-bordered table-hover">
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
                            <a title="Visualizar" href="{{ route('motorista.show', $motorista) }}" class="btn btn-outline-dark move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('motorista.edit', $motorista) }}" class="btn btn-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('motorista.destroy', $motorista) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button title="Excluir" class="btn btn-danger move" onclick="return confirm('Tem certeza?')">
                                    <i class="fas fa-trash"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
