<?php

namespace App\Http\Controllers;

use App\Models\ProdutoFornecedor;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoFornecedorController extends Controller
{
    public function index()
    {
        $produtosXFornecedores = ProdutoFornecedor::with(['fornecedor', 'produto'])->get();
        return view('produtoFornecedor.index', compact('produtosXFornecedores'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        return view('produtoFornecedor.create', compact('fornecedores', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->merge(['valor' => str_replace(['R$', '.', ','], ['', '', '.'], $request->valor)]);

        $request->validate([
            'id_fornecedor' => 'required|exists:fornecedor,id',
            'id_produto' => 'required|exists:produtos,id',
            'valor' => 'required|numeric',
        ]);
        ProdutoFornecedor::create($request->all());
        return redirect()->route('produtofornecedor.index')->with('success', 'Produto x Fornecedor criado com sucesso!');
    }

    public function edit(ProdutoFornecedor $produtofornecedor)
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        return view('produtoFornecedor.edit', compact('produtofornecedor', 'fornecedores', 'produtos'));
    }

    public function update(Request $request, ProdutoFornecedor $produtofornecedor)
    {
        $request->merge(['valor' => str_replace(['R$', '.', ','], ['', '', '.'], $request->valor)]);

        $request->validate([
            'id_fornecedor' => 'required|exists:fornecedor,id',
            'id_produto' => 'required|exists:produtos,id',
            'valor' => 'required|numeric',
        ]);
        $produtofornecedor->update($request->all());
        return redirect()->route('produtofornecedor.index')->with('success', 'Produto x Fornecedor atualizado com sucesso!');
    }

    public function destroy(ProdutoFornecedor $produtofornecedor)
    {
        $produtofornecedor->delete();
        return redirect()->route('produtofornecedor.index')->with('success', 'Produto x Fornecedor deletado com sucesso!');
    }
}
