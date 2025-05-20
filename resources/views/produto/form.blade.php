@csrf
<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}} name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao', $produto?->descricao) }}" required>

            @error('descricao')
            <div id="descricao-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="tipo_produto">Tipo de Produto</label>
            <div class="d-flex">
                <div class="form-check mr-4">
                    <input type="radio" {{isset($isDelete) ? 'disabled' : ''}}
                           class="form-check-input @error('tipo_produto') is-invalid @enderror"
                           name="tipo_produto"
                           id="tipo_produto_1"
                           value="1"
                        {{ old('tipo_produto', $produto?->tipo_produto ?? 1) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="tipo_produto_1">Produto</label>
                </div>
                <div class="form-check">
                    <input type="radio" {{isset($isDelete) ? 'disabled' : ''}}
                           class="form-check-input @error('tipo_produto') is-invalid @enderror"
                           name="tipo_produto"
                           id="tipo_produto_2"
                           value="2"
                        {{ old('tipo_produto', $produto?->tipo_produto ?? 1) == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="tipo_produto_2">Serviço</label>
                </div>
            </div>
            @error('tipo_produto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="unidade_medida">Unidade de Medida</label>
            <select {{isset($isDelete) ? 'disabled' : ''}} name="unidade_medida" id="unidade_medida" class="form-control" required>
                <option>Selecione</option>
                <option value="UN" {{$produto->unidade_medida == 'UN' ? 'selected' : ''}}>UN</option>
                <option value="KG" {{$produto->unidade_medida == 'KG' ? 'selected' : ''}}>KG</option>
                <option value="MT" {{$produto->unidade_medida == 'MT' ? 'selected' : ''}}>MT</option>
                <option value="MT3" {{$produto->unidade_medida == 'MT3' ? 'selected' : ''}}>MT³</option>
            </select>

            @error('unidade_medida')
            <div id="unidade_medida-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir - {{$produto->descricao}}</button>
        </div>
    @else
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    @endif
    <div class="col text-right">
        <a href="{{ route('produto.index') }}" class="btn btn-lg btn-secondary mb-3">Voltar</a>
    </div>
</div>

