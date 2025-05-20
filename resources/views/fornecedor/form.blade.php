@csrf
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}} name="razao_social" id="razao_social" class="form-control @error('razao_social') is-invalid @enderror" value="{{ old('razao_social', $fornecedor?->razao_social) }}" required>

            @error('razao_social')
            <div id="razao_social-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}}  name="cnpj" id="cnpj" value="{{ old('cnpj', $fornecedor?->cnpj) }}" class="form-control @error('cnpj') is-invalid @enderror">

            @error('cnpj')
            <div id="cnpj-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir - {{$fornecedor->razao_social}}</button>
        </div>
    @else
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    @endif
    <div class="col text-right">
        <a href="{{ route('fornecedor.index') }}" class="btn btn-lg btn-secondary mb-3">Voltar</a>
    </div>
</div>

