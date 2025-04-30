<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Motorista;
use App\Models\Pedidos;
use App\Models\Produto;
use Illuminate\Http\Request;

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
        $request->validate([
            'id_cliente' => 'nullable|exists:clientes,id',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'id_fornecedor' => 'required|exists:fornecedor,id',
            'id_produto' => 'required|exists:produtos,id',
            'valor' => 'required|numeric',
            'id_motorista' => 'nullable|exists:motoristas,id',
            'id_caminhao' => 'nullable|exists:caminhao,id',
            'pago' => 'boolean',
            'data_entrega' => 'nullable|date',
        ]);

        try{
            Pedidos::create($request->all());
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
                'id_fornecedor' => 'required|exists:fornecedor,id',
                'id_produto' => 'required|exists:produtos,id',
                'valor' => 'required|numeric',
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
        return view('pedidos.show', compact('pedido'));
    }
}
