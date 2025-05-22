@csrf
<div class="row">
    <!-- Cliente -->
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select {{isset($isDelete) ? 'disabled' : ''}}
                    name="id_cliente"
                    id="id_cliente"
                    class="form-control @error('id_cliente') is-invalid @enderror"
                    required>
                <option value="">Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('id_cliente', $pedido?->id_cliente) == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
            @error('id_cliente')
            <div id="id_cliente-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- CEP -->
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="cep"
                   id="cep"
                   class="form-control @error('cep') is-invalid @enderror"
                   value="{{ old('cep', $pedido?->cep) }}"
                   required>
            @error('cep')
            <div id="cep-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <!-- Logradouro -->
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="logradouro"
                   id="logradouro"
                   class="form-control @error('logradouro') is-invalid @enderror"
                   value="{{ old('logradouro', $pedido?->logradouro) }}"
                   required>
            @error('logradouro')
            <div id="logradouro-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Número -->
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="number"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="numero"
                   id="numero"
                   class="form-control @error('numero') is-invalid @enderror"
                   value="{{ old('numero', $pedido?->numero) }}"
                   required>
            @error('numero')
            <div id="numero-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="complemento">Complemento</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="complemento"
                   id="complemento"
                   class="form-control @error('complemento') is-invalid @enderror"
                   value="{{ old('complemento', $pedido?->complemento) }}">
            @error('complemento')
            <div id="complemento-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="referencia">Referência</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="referencia"
                   id="referencia"
                   class="form-control @error('referencia') is-invalid @enderror"
                   value="{{ old('referencia', $pedido?->referencia) }}">
            @error('referencia')
            <div id="referencia-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="row">

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="bairro"
                   id="bairro"
                   class="form-control @error('bairro') is-invalid @enderror"
                   value="{{ old('bairro', $pedido?->bairro) }}"
                   required>
            @error('bairro')
            <div id="bairro-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="cidade"
                   id="cidade"
                   class="form-control @error('cidade') is-invalid @enderror"
                   value="{{ old('cidade', $pedido?->cidade) }}"
                   required>
            @error('cidade')
            <div id="cidade-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text"
                   {{isset($isDelete) ? 'disabled' : ''}}
                   name="estado"
                   id="estado"
                   class="form-control @error('estado') is-invalid @enderror"
                   value="{{ old('estado', $pedido?->estado) }}"
                   required>
            @error('estado')
            <div id="estado-invalid-feedback" class="invalid-feedback font-weight-bold" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
<hr class="hr-dalpra">

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <h3>Itens do Pedido</h3>

            <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#itemModal">Adicionar Item</button>

            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Fornecedor</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="itens-container">
                    @if(isset($pedido))
                        @foreach($pedido?->itemPedido as $item)
                            <tr>
                                <td>{{ $item->fornecedor->razao_social }}</td>
                                <td>{{ $item->produto->descricao }}</td>
                                <td>{{ $item->quantidade }}</td>
                                <td>{{ number_format($item->valor, 2, ',', '.') }}</td>
                                <td>
                                    <input type="hidden" name="fornecedores[]" value="{{ $item->fornecedor_id }}">
                                    <input type="hidden" name="produtos[]" value="{{ $item->produto_id }}">
                                    <input type="hidden" name="quantidades[]" value="{{ $item->quantidade }}">
                                    <input type="hidden" name="valores[]" value="{{ $item->valor }}">
                                    @if(!isset($isDelete))
                                        <button type="button" class="btn btn-danger btn-sm remove-item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Adicionar Item ao Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_fornecedor">Fornecedor</label>
                    <select name="id_fornecedor" id="id_fornecedor" class="form-control" required>
                        <option value="">Selecione</option>
                        @foreach($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}">{{ $fornecedor->razao_social }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_produto">Produto</label>
                    <select name="id_produto" id="id_produto" class="form-control" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade <span id="unidade_medida"> </span></label>
                    <input type="number" name="quantidade" id="quantidade" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label id="preco" for="valor">Preço de Venda</label>
                    <input type="text" name="valor" id="valor" class="form-control" value="" required step="0.01">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fecharModal" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="save-item">Salvar Item</button>
            </div>
        </div>
    </div>
</div>


<div class="row">
    @if(isset($isDelete))
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-danger">Excluir - {{$pedido->descricao}}</button>
        </div>
    @else
        <div class="col text-left">
            <button type="submit" class="btn btn-lg btn-success">Salvar</button>
        </div>
    @endif
    <div class="col text-right">
        <a href="{{ route('pedido.index') }}" class="btn btn-lg btn-secondary mb-3">Voltar</a>
    </div>
</div>

