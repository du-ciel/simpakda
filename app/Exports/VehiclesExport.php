<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class VehiclesExport
{
    protected array $vehicles;

    public function __construct(array $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function forVehicles(array $vehicles): self
    {
        $this->vehicles = $vehicles;

        return $this;
    }

    public function downloadXlsx(): void
    {
        $spreadsheet = $this->buildSpreadsheet();
        $writer = new Xlsx($spreadsheet);
        $filename = 'data-kendaraan-'.date('Y-m-d-His').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function downloadCsv(): void
    {
        $spreadsheet = $this->buildSpreadsheet();
        $writer = new Csv($spreadsheet);
        $writer->setDelimiter(',');
        $writer->setEnclosure('"');
        $writer->setLineEnding("\r\n");
        $writer->setUseBOM(true);
        $filename = 'data-kendaraan-'.date('Y-m-d-His').'.csv';

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    protected function buildSpreadsheet(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'No Polisi',
            'Merek',
            'Tipe',
            'Jenis',
            'Kategori',
            'Sub Kategori',
            'Pemakai',
            'Jabatan',
            'Tahun Pemakaian',
            'Masa Berlaku Pajak',
            'Masa Berlaku STNK',
            'Status Pajak',
            'Status Kendaraan',
            'No Chasis',
            'No Mesin',
            'Sumber Dana',
            'Anggaran Biaya',
            'Biaya Plat/STNK',
            'Keterangan Pajak',
            'Keterangan Kendaraan',
        ];

        $sheet->setAutoFilter('A1:U1');
        $sheet->getRowDimension(1)->setRowHeight(30);

        $colIndex = 1;
        foreach ($headers as $header) {
            $cell = $sheet->getCell(Coordinate::stringFromColumnIndex($colIndex).'1');
            $cell->setValue($header);
            $cell->getStyle()->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0D9488'],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            $colIndex++;
        }

        $no = 1;
        $row = 2;
        foreach ($this->vehicles as $v) {
            $sheet->getRowDimension($row)->setRowHeight(20);

            $data = [
                $no,
                $v->nomor_polisi,
                $v->merek,
                $v->tipe,
                $v->jenis,
                $v->kategori,
                $v->sub_kategori ?? '',
                $v->nama_pemakai,
                $v->jabatan_pemakai,
                $v->tahun_pemakaian,
                $v->masa_berlaku_pajak->format('d/m/Y'),
                $v->masa_berlaku_stnk->format('d/m/Y'),
                $v->isPajakExpired() ? 'Expired' : 'Aktif',
                ucfirst(str_replace('_', ' ', $v->status)),
                $v->nomor_chasis,
                $v->nomor_mesin,
                $v->sumber_dana,
                $v->anggaran_biaya,
                $v->biaya_plat_stnk,
                $v->keterangan_pajak ?? '',
                $v->keterangan_kendaraan ?? '',
            ];

            $colIndex = 1;
            foreach ($data as $value) {
                $cell = $sheet->getCell(Coordinate::stringFromColumnIndex($colIndex).$row);
                $cell->setValue($value);

                $cell->getStyle()->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E2E8F0'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                if ($colIndex === 1) {
                    $cell->getStyle()->applyFromArray([
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }

                $colIndex++;
            }

            $no++;
            $row++;
        }

        foreach (range('A', 'U') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->freezePane('A2');

        return $spreadsheet;
    }
}
