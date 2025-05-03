<?php

namespace App\Exports;

use App\Models\ItemPedido;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Pedidos;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RelatorioVendasExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = session()->get('export_pedidos')[0];;
    }

    public function collection()
    {
        $pedidos = ItemPedido::query()
            ->join('entregas', 'item_pedido.id_entrega', '=', 'entregas.id') // Ajuste os nomes das colunas conforme necessário
            ->select('item_pedido.*', 'entregas.*'); // Selecione os campos que você deseja

        session()->forget('export_pedidos');

        if ($this->data['data_inicio'] && $this->data['data_fim']) {
            $pedidos->whereBetween('entregas.data_entrega', [$this->data['data_inicio'], $this->data['data_fim']]);
        }

        if ($this->data['fornecedor_id']) {
            $pedidos->where('item_pedido.id_fornecedor', $this->data['fornecedor_id']);
        }

        if ($this->data['produto_id']) {
            $pedidos->where('item_pedido.id_produto', $this->data['produto_id']);
        }

        if ($this->data['caminhao_id']) {
            $pedidos->where('entregas.id_caminhao', $this->data['caminhao_id']);
        }

        if ($this->data['pago'] && $this->data['pago'] != 2) {
            $pedidos->where('entregas.pago', $this->data['pago'] ? 1 : 0);
        }

        if ($this->data['motorista_id']) {
            $pedidos->where('entregas.id_motorista', $this->data['motorista_id']);
        }

        $pedidos->whereNotNull('item_pedido.id_entrega');
        $pedidos->orderBy('entregas.data_entrega', 'asc');
        return $pedidos->get();
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Produto',
            'Quantidade (em mt³)',
            'Fornecedor',
            'Motorista',
            'Data de Entrega',
            'Valor',
        ];
    }

    public function map($row): array
    {
        return [
            $row?->pedidos?->clientes ? $row->pedidos->clientes->nome : 'N/A',
            $row?->produtos?->descricao ?? 'N/A',
            $row->quantidade,
            $row->fornecedor ? $row->fornecedor->razao_social : 'N/A',
            $row?->entregas?->motoristas ? $row?->entregas?->motoristas?->nome : 'N/A',
            $row->data_entrega ? date('d/m/Y', strtotime($row->data_entrega)) : 'N/A',
            number_format($row->valor, 2, ',', '.')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $linhaFiltros = $linhaFiltroInicial = $highestRow + 2;

                $sheet->setCellValue('A' . $linhaFiltros, 'Relatório de Pedidos');
                $sheet->setCellValue('A' . $linhaFiltros++, 'Data da Exportação: ' . now()->format('d/m/Y H:i:s'));

                if ($this->data) {
                    $sheet->setCellValue('A' . $linhaFiltros++, 'Data da Geração: ' . $this->data['data_geracao']);
                    if (isset($this->data['data_inicio'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Data Início do Período: ' . date("d/m/Y", strtotime($this->data['data_inicio'])));
                    }
                    if (isset($this->data['data_fim'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Data Fim do Período: ' . date("d/m/Y", strtotime($this->data['data_fim'])));
                    }
                    if (isset($this->data['fornecedor_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Fornecedor: ' . $this->data['fornecedor_id']);
                    }
                    if (isset($this->data['motorista_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Motorista: ' . $this->data['motorista_id']);
                    }
                    if (isset($this->data['produto_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Produto: ' . $this->data['produto_id']);
                    }
                    if (isset($this->data['caminhao_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Caminhão: ' . $this->data['caminhao_id']);
                    }
                }
                $cellRange = "A1:E" .$linhaFiltroInicial-2;
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Ajuste de estilo
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('B1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('D1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('E1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('F1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('G1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A' .$linhaFiltroInicial . ':A' . $linhaFiltros)->getFont()->setItalic(true)->setSize(10);
            }
        ];
    }
}
