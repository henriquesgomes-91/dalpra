<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:100',
        ]);
        Produto::create($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'descricao' => 'required|string|max:100',
        ]);
        $produto->update($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso!');
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

    public function valorPorProduto($id)
    {
        $produto = ProdutoFornecedor::where('id_produto', $id)->first();
        return response()->json(['valor' => $produto->valor]);
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }
}
