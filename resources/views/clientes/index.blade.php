@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Clientes')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_clientes').DataTable({
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "zeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "emptyTable": "Nenhum registro encontrado.",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Cadastro de Clientes</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('clientes.create') }}" class="btn button-dalpra mb-3"><b>Novo Cliente</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_clientes" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-4">Nome</th>
                    <th class="col-3">Email</th>
                    <th class="col-2">Telefone</th>
                    <th class="col-3">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td class="col-4">{{ $cliente->nome }}</td>
                        <td class="col-3">{{ $cliente->email }}</td>
                        <td class="col-2">{{ $cliente->telefone }}</td>
                        <td class="col-3 text-center">
                            <a title="Visualizar"  href="{{ route('clientes.show', $cliente) }}" class="btn btn-outline-dark move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button title="Excluir"  class="btn btn-danger move" onclick="return confirm('Tem certeza?')">
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

