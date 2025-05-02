<?php
namespace App\Http\Controllers;

use App\Models\Pedidos;
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

        return view('relatorios.vendas.relatorio', compact( 'fornecedores', 'motoristas'));

    }

    public function generate(Request $request)
    {
        $fornecedores = Fornecedor::get();
        $motoristas = Motorista::get();
        $pedidos = Pedidos::query();

        session()->forget('export_pedidos');

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $pedidos->whereBetween('data_entrega', [$request->data_inicio, $request->data_fim]);
        }

        if ($request->filled('fornecedor_id')) {
            $pedidos->where('id_fornecedor', $request->fornecedor_id);
        }

        if ($request->filled('pago')) {
            $pedidos->where('pago', $request->pago ? 1 : 0);
        }

        if ($request->filled('motorista_id')) {
            $pedidos->where('id_motorista', $request->motorista_id);
        }
        $arFilter = $request->only(['data_inicio', 'data_fim', 'fornecedor_id', 'motorista_id', 'pago']);
        $arFilter['data_geracao'] = date('d/m/Y H:i:s');

        session()->push('export_pedidos', $arFilter);
        $pedidos = $pedidos->get();
        return view('relatorios.vendas.resultado', compact('pedidos', 'fornecedores', 'motoristas'));
    }

    public function exportar(Request $request)
    {
        return Excel::download(new RelatorioVendasExport($request->all()), 'relatorio_vendas.xlsx');
    }
}
