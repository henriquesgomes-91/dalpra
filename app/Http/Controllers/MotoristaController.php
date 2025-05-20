<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSaveMotorista;
use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index(Request $request)
    {
        $motoristas = Motorista::paginate(10);
        return view('motorista.index', compact('motoristas'));
    }

    public function create()
    {
        return view('motorista.create', [
            'motorista' => new Motorista
        ]);
    }

    public function store(FormRequestSaveMotorista $request)
    {
        $dadosRequest = $request->validated();

        if(Motorista::create($dadosRequest)){
            return redirect()->route('motorista.index')->with('success', 'Motorista criado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function show($id, $str)
    {
        $motorista = Motorista::findOrFail($id);
        $isDelete = $str == 'R';
        return view('motorista.show', compact('motorista', 'isDelete'));
    }

    public function edit($id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motorista.edit', compact('motorista'));
    }

    public function update(FormRequestSaveMotorista $request, $id)
    {
        $dadosRequest = $request->validated();
        $motorista = Motorista::findOrFail($id);

        if($motorista->update($dadosRequest)){
            return redirect()->route('motorista.index')->with('success', 'Motorista atualizado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $motorista = Motorista::findOrFail($id);
        $motorista->delete();
        return redirect()->route('motorista.index')->with('success', 'Motorista deletado com sucesso!');
    }
}
