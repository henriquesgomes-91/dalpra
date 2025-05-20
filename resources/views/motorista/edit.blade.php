@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss'])
@endpush
@section('title', 'Editar Motorista - ' . $motorista->nome)
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#comissao').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        });
    </script>
@endpush
@section('content_header')
    <h1>Editar Motorista - {{$motorista->nome}}</h1>
    <hr class="hr-dalpra">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('motorista.update', $motorista) }}" method="POST">
                @method('PUT')
                @include('motorista.form')
            </form>
        </div>
    </div>
@endsection
