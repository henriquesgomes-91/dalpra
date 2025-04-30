<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use Illuminate\Http\Request;

class CaminhaoController extends Controller
{
    public function index()
    {
        $caminhoes = Caminhao::orderBy('id', 'desc')->paginate(10);
        return view('caminhao.index', compact('caminhoes'));
    }

    public function create()
    {
        return view('caminhao.create');
    }

    public function store(Request $request)
    {
        $dadosRequest = $request->validate([
            'descricao' => 'required|string|max:255',
            'placa' => 'nullable|string|max:20',
        ]);

        $arDadosCaminhao['descricao'] = $dadosRequest['descricao'];
        $arDadosCaminhao['placa'] = $dadosRequest['placa'];

        Caminhao::create($arDadosCaminhao);

        return redirect()->route('caminhao.index')->with('success', 'Caminhão criado com sucesso!');
    }

    public function edit($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        return view('caminhao.edit', compact('caminhao'));
    }

    public function update(Request $request, Caminhao $caminhao)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'placa' => 'nullable|string|max:20',
        ]);

        $caminhao->update($request->all());

        return redirect()->route('caminhao.index')->with('success', 'Caminhão atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        $caminhao->delete();
        return redirect()->route('caminhao.index')->with('success', 'Caminhão removido!');
    }


    public function show($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        return view('caminhao.show', compact('caminhao'));
    }
}
