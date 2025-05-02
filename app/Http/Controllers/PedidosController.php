<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\ItemPedido;
use App\Models\Motorista;
use App\Models\Pedidos;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::get();
        $fornecedores = Fornecedor::get();
        $motoristas = Motorista::get();
        $caminhoes = Caminhao::get();
        return view('pedidos.create', compact('clientes', 'fornecedores', 'motoristas', 'caminhoes'));
    }

    public function store(Request $request)
    {
        $arDados = $request->validate([
            'id_cliente' => 'nullable|exists:clientes,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'fornecedores' => '',
            'produtos' => '',
            'valores' => '',
            'id_motorista' => 'nullable|exists:motoristas,id',
            'id_caminhao' => 'nullable|exists:caminhao,id',
            'pago' => 'boolean',
            'data_entrega' => 'nullable|date',
        ]);

        try{
            $arItens = array_merge(['fornecedores' => $arDados['fornecedores']], ['produtos' => $arDados['produtos']], ['valores' => $arDados['valores']]);
            DB::transaction(function () use ($arDados, $arItens) {
                unset($arDados['fornecedores']);
                unset($arDados['produtos']);
                unset($arDados['valores']);
                $objPedido = Pedidos::create($arDados);

                DB::commit();
                foreach ($arItens['fornecedores'] as $key => $value) {
                    $arDadosInsertItem['id_pedido'] = $objPedido->id;
                    $arDadosInsertItem['id_fornecedor'] = $value;
                    $arDadosInsertItem['id_produto'] = $arItens['produtos'][$key];
                    $arDadosInsertItem['valor'] = $arItens['valores'][$key];
                    ItemPedido::create($arDadosInsertItem);
                }
                DB::commit();
            });


        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function edit(Pedidos $pedido)
    {
        $clientes = Cliente::get();
        $fornecedores = Fornecedor::get();
        $motoristas = Motorista::get();
        $produtos = Produto::get();
        $caminhoes = Caminhao::get();
        return view('pedidos.edit', compact('pedido', 'clientes', 'fornecedores', 'motoristas', 'caminhoes', 'produtos'));
    }

    public function update(Request $request, Pedidos $pedido)
    {
        try{
            $request->validate([
                'id_cliente' => 'nullable|exists:clientes,id',
                'logradouro' => 'required|string|max:255',
                'numero' => 'required|string|max:10',
                'complemento' => 'nullable|string|max:100',
                'bairro' => 'required|string|max:100',
                'cidade' => 'required|string|max:100',
                'estado' => 'required|string|max:2',
                'id_motorista' => 'nullable|exists:motoristas,id',
                'id_caminhao' => 'nullable|exists:caminhao,id',
                'pago' => 'boolean',
                'data_entrega' => 'nullable|date',
            ]);

            $pedido->update($request->all());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedidos $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido deletado com sucesso!');
    }


    public function show($id)
    {
        $pedido = Pedidos::findOrFail($id);
        dd($pedido->itemPedido->toArray());
        return view('pedidos.show', compact('pedido'));
    }
}
