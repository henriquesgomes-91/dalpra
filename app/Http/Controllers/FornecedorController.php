<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSaveFornecedor;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $fornecedores = Fornecedor::paginate(10);
        return view('fornecedor.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedor.create', [
            'fornecedor' => new Fornecedor
        ]);
    }

    public function store(FormRequestSaveFornecedor $request)
    {
        $dadosRequest = $request->validated();

        if(Fornecedor::create($dadosRequest)){
            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor criado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function show($id, $str)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $isDelete = $str == 'R';
        return view('fornecedor.show', compact('fornecedor', 'isDelete'));
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedor.edit', compact('fornecedor'));
    }

    public function update(FormRequestSaveFornecedor $request, $id)
    {
        $dadosRequest = $request->validated();
        $fornecedor = Fornecedor::findOrFail($id);

        if($fornecedor->update($dadosRequest)){
            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor atualizado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('fornecedor.index')->with('success', 'Fornecedor deletado com sucesso!');
    }
}
