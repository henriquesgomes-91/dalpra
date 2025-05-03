<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\ItemPedido;
use App\Models\Motorista;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entregas = ItemPedido::whereNotNull('id_entrega')->get();
        return view('entregas.index', compact('entregas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caminhoes = Caminhao::get();
        $motoristas = Motorista::get();
        $pedidos = Pedidos::get();
        return view('entregas.create', compact('caminhoes', 'motoristas', 'pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosRequest = $request->validate([
            'id_motorista' => 'required||exists:motoristas,id',
            'id_caminhao' => 'required||exists:caminhao,id',
            'itens' => 'required|array'
        ]);

        foreach ($dadosRequest['itens'] as $itemPedido => $item) {
            if($item['data_entrega'] != null){
                $entrega = Entrega::create([
                    'id_motorista' => $dadosRequest['id_motorista'],
                    'id_caminhao' => $dadosRequest['id_caminhao'],
                    'pago' => isset($item['pago']) ? 1 : 0,
                    'data_entrega' => $item['data_entrega']
                ]);

                $objItem = ItemPedido::findOrFail($itemPedido);
                $objItem->update(['id_entrega' => $entrega->id]);
            }

        }
        return redirect()->route('entregas.index')->with('success', 'Entrega criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entrega = Entrega::findOrFail($id);
        $itensPedido = ItemPedido::where('id_entrega', $id)->get();
        return view('entregas.show', compact('entrega', 'itensPedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entrega = Entrega::findOrFail($id);
        $caminhoes = Caminhao::get();
        $motoristas = Motorista::get();
        $pedidos = Pedidos::get();
        $itensPedido = ItemPedido::where('id_entrega', $id)->get();
        return view('entregas.edit', compact('itensPedido', 'entrega', 'caminhoes', 'motoristas', 'pedidos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dadosRequest = $request->validate([
            'id_motorista' => 'required||exists:motoristas,id',
            'id_caminhao' => 'required||exists:caminhao,id',
            'itens' => 'required|array'
        ]);

        $entrega = Entrega::findOrFail($id);
        $entrega->update([
            'id_motorista' => $dadosRequest['id_motorista'],
            'id_caminhao' => $dadosRequest['id_caminhao']
        ]);

        foreach ($dadosRequest['itens'] as $itemPedido => $item) {
            if($item['data_entrega'] != null){
                $entrega = Entrega::create([
                    'id_motorista' => $dadosRequest['id_motorista'],
                    'id_caminhao' => $dadosRequest['id_caminhao'],
                    'pago' => isset($item['pago']) ? 1 : 0,
                    'data_entrega' => $item['data_entrega']
                ]);

                $objItem = ItemPedido::findOrFail($itemPedido);
                $objItem->update(['id_entrega' => $entrega->id]);
            }

        }
        return redirect()->route('entregas.index')->with('success', 'Entrega alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $itensPedido = ItemPedido::where('id_entrega', $id)->get();
        if($itensPedido) {
            foreach ($itensPedido as $item) {
                $item->update(['id_entrega' => null]);
            }
        }

        $entrega = Entrega::findOrFail($id);
        $entrega->delete();

        return redirect()->route('entregas.index')->with('success', 'Entrega removida!');
    }

    public function getItens($id)
    {
        $pedido = Pedidos::findOrFail($id);
        return response()->json(['itens' => $pedido->itemPedido]);
    }
}
