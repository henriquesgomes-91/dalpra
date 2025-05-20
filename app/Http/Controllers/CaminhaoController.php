<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSaveCaminhao;
use App\Models\Caminhao;
use Illuminate\Http\Request;

class CaminhaoController extends Controller
{
    public function index(Request $request)
    {
        $caminhoes = Caminhao::paginate(10);
        return view('caminhao.index', compact('caminhoes'));
    }

    public function create()
    {
        return view('caminhao.create', [
            'caminhao' => new Caminhao
        ]);
    }

    public function store(FormRequestSaveCaminhao $request)
    {
        $dadosRequest = $request->validated();

        if(Caminhao::create($dadosRequest)){
            return redirect()->route('caminhao.index')->with('success', 'Caminhão criado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function show($id, $str)
    {
        $caminhao = Caminhao::findOrFail($id);
        $isDelete = $str == 'R';
        return view('caminhao.show', compact('caminhao', 'isDelete'));
    }

    public function edit($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        return view('caminhao.edit', compact('caminhao'));
    }

    public function update(FormRequestSaveCaminhao $request, $id)
    {
        $dadosRequest = $request->validated();
        $caminhao = Caminhao::findOrFail($id);

        if($caminhao->update($dadosRequest)){
            return redirect()->route('caminhao.index')->with('success', 'Caminhão atualizado com sucesso!');
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        $caminhao->delete();
        return redirect()->route('caminhao.index')->with('success', 'Caminhão deletado com sucesso!');
    }

}
