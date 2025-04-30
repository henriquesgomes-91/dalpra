<?php

namespace App\Exports;

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
        return Pedidos::whereBetween('data_entrega', [$this->data['data_inicio'], $this->data['data_fim']])
            ->when($this->data['fornecedor_id'], function ($query) {
                return $query->where('fornecedor_id', $this->data['fornecedor_id']);
            })
            ->when($this->data['motorista_id'], function ($query) {
                return $query->where('motorista_id', $this->data['motorista_id']);
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fornecedor',
            'Motorista',
            'Data de Entrega',
            'Valor',
        ];
    }

    public function map($row): array
    {
        return [
            str_pad($row->id, 6, '0', STR_PAD_LEFT),
            $row->fornecedor ? $row->fornecedor->razao_social : 'N/A',
            $row->motoristas ? $row->motoristas->nome : 'N/A',
            $row->data_entrega ? date("d/m/Y", strtotime($row->data_entrega)) : '',
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
                $arFilter = session()->get('export_pedidos')[0];

                $sheet->setCellValue('A' . $linhaFiltros, 'Relatório de Pedidos');
                $sheet->setCellValue('A' . $linhaFiltros++, 'Data da Exportação: ' . now()->format('d/m/Y H:i:s'));

                if ($arFilter) {
                    $sheet->setCellValue('A' . $linhaFiltros++, 'Data da Geração: ' . $arFilter['data_geracao']);
                    if (isset($arFilter['data_inicio'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Data Início do Período: ' . date("d/m/Y", strtotime($arFilter['data_inicio'])));
                    }
                    if (isset($arFilter['data_fim'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Data Fim do Período: ' . date("d/m/Y", strtotime($arFilter['data_fim'])));
                    }
                    if (isset($arFilter['fornecedor_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Fornecedor: ' . $arFilter['fornecedor_id']);
                    }
                    if (isset($arFilter['motorista_id'])) {
                        $sheet->setCellValue('A' . $linhaFiltros++, 'Motorista: ' . $arFilter['motorista_id']);
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
                $sheet->getStyle('A' .$linhaFiltroInicial . ':A' . $linhaFiltros)->getFont()->setItalic(true)->setSize(10);
            }
        ];
    }
}
