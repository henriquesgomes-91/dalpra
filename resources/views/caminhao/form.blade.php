@csrf
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}} name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao', $caminhao?->descricao) }}" required>

            @error('descricao')
            <div id="descricao-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}}  name="placa" id="placa" value="{{ old('placa', $caminhao?->placa) }}" class="form-control @error('placa') is-invalid @enderror">

            @error('placa')
            <div id="placa-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir - {{$caminhao->descricao}}</button>
        </div>
    @else
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    @endif
    <div class="col text-right">
        <a href="{{ route('caminhao.index') }}" class="btn btn-lg btn-secondary mb-3">Voltar</a>
    </div>
</div>

