@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Clientes')

@push('js')
    <script>
        window.$ = window.jQuery = require('jquery');
        require('datatables.net');
        $(document).ready(function() {
            $('#tabela_caminhao').DataTable({
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
    <h1>Cadastro de Caminhões</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('caminhao.create') }}" class="btn button-dalpra mb-3"><b>Novo Caminhão</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_caminhao" class="table table-bordered table-hover">
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
                            <a title="Visualizar"  href="{{ route('caminhao.show', $caminhao) }}" class="btn btn-outline-dark move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('caminhao.edit', $caminhao) }}" class="btn btn-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('caminhao.destroy', $caminhao) }}" method="POST" style="display:inline-block">
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

