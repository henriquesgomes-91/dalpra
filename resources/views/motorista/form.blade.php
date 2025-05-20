@csrf
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}} name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $motorista?->nome) }}" required>

            @error('nome')
            <div id="nome-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="comissao">Comissão</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}}  name="comissao" id="comissao" value="{{ old('comissao', $motorista?->comissao) }}" class="form-control @error('comissao') is-invalid @enderror">

            @error('comissao')
            <div id="comissao-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir - {{$motorista->nome}}</button>
        </div>
    @else
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    @endif
    <div class="col text-right">
        <a href="{{ route('motorista.index') }}" class="btn btn-lg btn-secondary mb-3">Voltar</a>
    </div>
</div>

