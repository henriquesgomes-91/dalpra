<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::get();
        return view('fornecedor.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedor.create');
    }

    public function store(Request $request)
    {
        $request->merge(['cnpj' => preg_replace('/[^0-9]/', '', $request->cnpj)]);

        $request->validate([
            'razao_social' => 'required|string|max:100',
            'cnpj' => 'required|string|max:15',
        ]);

        Fornecedor::create($request->all());
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor criado com sucesso!');
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedor.edit', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    { // Remover máscara
        $request->merge(['cnpj' => preg_replace('/[^0-9]/', '', $request->cnpj)]);

        $request->validate([
            'razao_social' => 'required|string|max:100',
            'cnpj' => 'required|string|max:15',
        ]);


        $fornecedor->update($request->all());
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor deletado com sucesso!');
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedor.show', compact('fornecedor'));
    }
}
