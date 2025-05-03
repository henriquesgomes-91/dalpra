<?php
namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Entrega;
use App\Models\ItemPedido;
use App\Models\Pedidos;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Motorista;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatorioVendasExport;

class RelatorioController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::get();
        $motoristas = Motorista::get();
        $produtos = Produto::get();
        $caminhoes = Caminhao::get();

        return view('relatorios.entregas.relatorio', compact( 'fornecedores', 'motoristas', 'produtos', 'caminhoes'));

    }

    public function generate(Request $request)
    {
        $pedidos = ItemPedido::query()
            ->join('entregas', 'item_pedido.id_entrega', '=', 'entregas.id') // Ajuste os nomes das colunas conforme necessário
            ->select('item_pedido.*', 'entregas.*'); // Selecione os campos que você deseja

        session()->forget('export_pedidos');

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $pedidos->whereBetween('entregas.data_entrega', [$request->data_inicio, $request->data_fim]);
        }

        if ($request->filled('fornecedor_id')) {
            $pedidos->where('item_pedido.id_fornecedor', $request->fornecedor_id);
        }

        if ($request->filled('produto_id')) {
            $pedidos->where('item_pedido.id_produto', $request->produto_id);
        }

        if ($request->filled('caminhao_id')) {
            $pedidos->where('entregas.id_caminhao', $request->caminhao_id);
        }

        if ($request->filled('pago') && $request->pago != 2) {
            $pedidos->where('entregas.pago', $request->pago ? 1 : 0);
        }

        if ($request->filled('motorista_id')) {
            $pedidos->where('entregas.id_motorista', $request->motorista_id);
        }

        $pedidos->whereNotNull('item_pedido.id_entrega');
        $pedidos->orderBy('entregas.data_entrega', 'asc');
        $arFilter = $request->only(['data_inicio', 'data_fim', 'fornecedor_id', 'produto_id', 'caminhao_id', 'motorista_id', 'pago']);
        $arFilter['data_geracao'] = date('d/m/Y H:i:s');

        session()->push('export_pedidos', $arFilter);
        $pedidos = $pedidos->get();
        return view('relatorios.entregas.resultado', compact('pedidos'));
    }

    public function exportar(Request $request)
    {
        return Excel::download(new RelatorioVendasExport($request->all()), 'relatorio_entregas.xlsx');
    }
}
