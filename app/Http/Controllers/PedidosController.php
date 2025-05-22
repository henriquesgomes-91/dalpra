<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestSavePedido;
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
    public function index(Request $request)
    {
        $pedidos = Pedidos::paginate(10);
        return view('pedido.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::get();
        $fornecedores = Fornecedor::get();
        $pedido = new Pedidos;
        return view('pedido.create', compact('pedido', 'clientes', 'fornecedores'));
    }

    public function store(FormRequestSavePedido $request)
    {
        $arDados = $request->validated();
        dd($arDados);
        try{
            $arItens = array_merge(['quantidades' => $arDados['quantidades']],['fornecedores' => $arDados['fornecedores']], ['produtos' => $arDados['produtos']], ['valores' => $arDados['valores']]);
            DB::transaction(function () use ($arDados, $arItens) {
                unset($arDados['fornecedores']);
                unset($arDados['produtos']);
                unset($arDados['quantidades']);
                unset($arDados['valores']);
                $objPedido = Pedidos::create($arDados);

                DB::commit();
                $intTotalPedido = 0;
                foreach ($arItens['fornecedores'] as $key => $value) {
                    $arDadosInsertItem['id_pedido'] = $objPedido->id;
                    $arDadosInsertItem['id_fornecedor'] = $value;
                    $arDadosInsertItem['id_produto'] = $arItens['produtos'][$key];
                    $arDadosInsertItem['valor'] = $arItens['valores'][$key];
                    $arDadosInsertItem['quantidade'] = $arItens['quantidades'][$key] ?? 0;
                    $intTotalPedido+= $arItens['valores'][$key];
                    ItemPedido::create($arDadosInsertItem);
                }
                $objPedido->update(['valor' => $intTotalPedido]);
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
        return view('pedidos.edit', compact('pedido', 'clientes', 'fornecedores'));
    }

    public function update(Request $request, Pedidos $pedido)
    {
        $arDados = $request->validate([
            'id_cliente' => 'nullable|exists:clientes,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'quantidades' => '',
            'fornecedores' => '',
            'produtos' => '',
            'valores' => ''
        ]);

        try{
            $arItens = array_merge(['quantidades' => $arDados['quantidades']],['fornecedores' => $arDados['fornecedores']], ['produtos' => $arDados['produtos']], ['valores' => $arDados['valores']]);
            DB::transaction(function () use ($arDados, $arItens, $pedido) {
                unset($arDados['fornecedores']);
                unset($arDados['produtos']);
                unset($arDados['quantidades']);
                unset($arDados['valores']);
                $pedido->update($arDados);

                $pedido->itemPedido->each(function ($item) {
                    $item->delete();
                });

                DB::commit();
                $intTotalPedido = 0;
                foreach ($arItens['fornecedores'] as $key => $value) {
                    $arDadosInsertItem['id_pedido'] = $pedido->id;
                    $arDadosInsertItem['id_fornecedor'] = $value;
                    $arDadosInsertItem['id_produto'] = $arItens['produtos'][$key];
                    $arDadosInsertItem['quantidade'] = $arItens['quantidades'][$key] ?? 0;
                    $arDadosInsertItem['valor'] = $arItens['valores'][$key];
                    $intTotalPedido+= $arItens['valores'][$key];
                    ItemPedido::create($arDadosInsertItem);
                }
                $pedido->update(['valor' => $intTotalPedido]);
                DB::commit();
            });


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


    public function show($id, $str)
    {
        $pedido = Pedidos::findOrFail($id);
        $isDelete = $str == 'R';
        return view('pedido.show', compact('pedido', 'isDelete'));
    }
}
