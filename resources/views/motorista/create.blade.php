@extends('adminlte::page')
@push('css')
    @vite(['resources/sass/custom.scss', 'resources/js/custom.js'])
@endpush
@section('title', 'Cadastrar Motorista')
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
    <h1>Cadastrar Motorista</h1>
    <hr class="hr-dalpra">
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row table-responsive">
        <div class="col-12">
            <form action="{{ route('motorista.store') }}" method="POST">
                @include('motorista.form')
            </form>
        </div>
    </div>
@endsection
