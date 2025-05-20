<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSaveProdutoFornecedor;
use App\Models\ProdutoFornecedor;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoFornecedorController extends Controller
{
    public function index($idFornecedor)
    {
        $produtos = ProdutoFornecedor::where('id_fornecedor', $idFornecedor)->paginate(10);
        return view('fornecedor.produto.index', compact('produtos', 'idFornecedor'));
    }

    public function create($idFornecedor)
    {
        $produtosDoFornecedor = ProdutoFornecedor::where('id_fornecedor', $idFornecedor)
            ->pluck('id_produto')
            ->toArray();

        $produtosDisponiveis = Produto::whereNotIn('id', $produtosDoFornecedor)
            ->get();

        return view('fornecedor.produto.create', [
            'produtoFornecedor' => new ProdutoFornecedor,
            'idFornecedor' => $idFornecedor,
            'produtos' => $produtosDisponiveis
        ]);
    }

    public function store(FormRequestSaveProdutoFornecedor $request, $idFornecedor)
    {
        $dadosRequest = $request->validated();

        if(ProdutoFornecedor::create($dadosRequest)){
            return redirect()->route('fornecedor.produto.index', ['idFornecedor' => $idFornecedor])
                ->with('success', 'Produto cadastrado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function show($idFornecedor, $id, $str)
    {
        $produto = ProdutoFornecedor::findOrFail($id);
        $isDelete = $str == 'R';
        return view('fornecedor.produto.show', compact('produto', 'isDelete', 'idFornecedor'));
    }

    public function edit($idFornecedor, $id)
    {
        $produto = ProdutoFornecedor::findOrFail($id);
        return view('fornecedor.produto.edit', compact('produto', 'idFornecedor'));
    }

    public function update(FormRequestSaveProdutoFornecedor $request, $idFornecedor, $id)
    {
        $dadosRequest = $request->validated();
        $produto = ProdutoFornecedor::findOrFail($id);

        if($produto->update($dadosRequest)){
            return redirect()->route('fornecedor.produto.index', ['idFornecedor' => $idFornecedor])
                ->with('success', 'Produto atualizado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($idFornecedor, $id)
    {
        $produto = ProdutoFornecedor::findOrFail($id);
        $produto->delete();
        return redirect()->route('fornecedor.produto.index', ['idFornecedor' => $idFornecedor])
            ->with('success', 'Produto deletado com sucesso!');
    }
}
