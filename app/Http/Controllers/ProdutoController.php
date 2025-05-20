<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSaveProduto;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::paginate(5);
        return view('produto.index', compact('produtos'));
    }

    public function create()
    {
        return view('produto.create', [
            'produto' => new Produto
        ]);
    }

    public function store(FormRequestSaveProduto $request)
    {
        $dadosRequest = $request->validated();
        if(Produto::create($dadosRequest)){
            return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function show($id, $str)
    {
        $produto = Produto::findOrFail($id);
        $isDelete = $str == 'R';
        return view('produto.show', compact('produto', 'isDelete'));
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.edit', compact('produto'));
    }

    public function update(FormRequestSaveProduto $request, $id)
    {
        $dadosRequest = $request->validated();
        $produto = Produto::findOrFail($id);

        if($produto->update($dadosRequest)){
            return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect()->route('produto.index')->with('success', 'Produto deletado com sucesso!');
    }

    public function produtosPorFornecedor($id)
    {
        $produtos = ProdutoFornecedor::where('id_fornecedor', $id)->get();
        $arRetorno = [];
        if($produtos) {
            foreach($produtos as $produto) {
                $produtoBase = Produto::where('id', $produto->id_produto)->first();
                $arRetorno[] = $produtoBase;
            }
        }
        return response()->json($arRetorno);
    }

    public function valorPorProduto($idFornecedor, $idProduto)
    {
        $produto = ProdutoFornecedor::where('id_fornecedor', $idFornecedor)->where('id_produto', $idProduto)->first();
        return response()->json(['preco_venda' => number_format($produto->preco_venda, 2)]);
    }

}
