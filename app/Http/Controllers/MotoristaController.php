<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::get();
        return view('motorista.index', compact('motoristas'));
    }

    public function create()
    {
        return view('motorista.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'comissao' => 'required|numeric',
        ]);
        Motorista::create($request->all());
        return redirect()->route('motorista.index')->with('success', 'Motorista criado com sucesso!');
    }

    public function edit($id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motorista.edit', compact('motorista'));
    }

    public function update(Request $request, Motorista $motorista)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'comissao' => 'required|numeric',
        ]);
        $motorista->update($request->all());
        return redirect()->route('motorista.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $motorista = Motorista::findOrFail($id);
        $motorista->delete();
        return redirect()->route('motorista.index')->with('success', 'Motorista deletado com sucesso!');
    }

    public function show($id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motorista.show', compact('motorista'));
    }
}
