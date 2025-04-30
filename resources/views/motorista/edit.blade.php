@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Motorista - ' . $motorista->nome)

@section('content_header')
    <h1>Editar Motorista - {{$motorista->nome}}</h1>
    <hr class="hr-dalpra">
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cnpj').mask('00.000.000/0000-00');
        });
    </script>
@endpush
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('motorista.update', $motorista) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ $motorista->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="nome">Comissao</label>
                    <input type="number" name="comissao" class="form-control" value="{{ $motorista->comissao ?? 0 }}" required>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('motorista.index') }}" class="btn btn-secondary mb-3">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

