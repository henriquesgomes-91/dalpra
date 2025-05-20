@csrf
<input type="hidden" name="id_fornecedor" value="{{$idFornecedor}}">
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="id_produto">Produto</label>
            <select name="id_produto" {{isset($isDelete) ? 'disabled' : ''}}  class="form-control @error('id_produto') is-invalid @enderror" required>
                <option>Selecione</option>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}" data-tipo="{{$produto->tipo_produto}}">{{ $produto->descricao }}</option>
                @endforeach
            </select>
            @error('id_produto')
            <div id="id_produto-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="custo">Custo</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}}  name="custo" id="custo" value="{{ old('custo', $produtoFornecedor?->custo) }}" class="form-control @error('custo') is-invalid @enderror">

            @error('custo')
            <div id="custo-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="preco_venda" id="preco">Preço de Venda</label>
            <input type="text" {{isset($isDelete) ? 'disabled' : ''}}  name="preco_venda" id="preco_venda" value="{{ old('preco_venda', $produtoFornecedor?->preco_venda) }}" class="form-control @error('preco_venda') is-invalid @enderror">

            @error('preco_venda')
            <div id="preco_venda-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir Vínculo</button>
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

