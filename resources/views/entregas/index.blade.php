@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Entregas')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_entregas').DataTable({
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
    <h1>Cadastro de Entregas</h1>
    <hr class="hr-dalpra">
    <a href="{{ route('entregas.create') }}" class="btn button-dalpra mb-3"><b>Nova Entrega</b></a>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <table id="tabela_entregas" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="col-2">Motorista</th>
                    <th class="col-2">Caminhão</th>
                    <th class="col-2">Fornecedor</th>
                    <th class="col-1">Produto</th>
                    <th class="col-1">Quantidade</th>
                    <th class="col-1">Pago?</th>
                    <th class="col-1">Data</th>
                    <th class="col-2">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($entregas as $entrega)
                    <tr>
                        <td class="col-2">{{ $entrega->entregas?->motoristas->nome ?? 'N/A' }}</td>
                        <td class="col-2">{{ $entrega->entregas?->caminhao->descricao ?? 'N/A' }} / {{ $entrega->entregas?->caminhao->placa ?? 'N/A' }}</td>
                        <td class="col-2">{{ $entrega->fornecedor->razao_social }}</td>
                        <td class="col-1">{{ $entrega->produtos->descricao }}</td>
                        <td class="col-1">{{ $entrega->quantidade }}</td>
                        <td class="col-1">{{ $entrega->entregas->pago ? 'Sim' : 'Nao' }}</td>
                        <td class="col-1">{{ $entrega->entregas->data_entrega ? date('d/m/Y', strtotime($entrega->entregas->data_entrega)) : 'N/A' }}</td>
                        <td class="col-2 text-center">
                            <a title="Visualizar"  href="{{ route('entregas.show', $entrega->entregas->id) }}" class="btn btn-outline-dark move">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a title="Editar" href="{{ route('entregas.edit', $entrega->entregas->id) }}" class="btn btn-primary move">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('entregas.destroy', $entrega->entregas->id) }}" method="POST" style="display:inline-block">
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

