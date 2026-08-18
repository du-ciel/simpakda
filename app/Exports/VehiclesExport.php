<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function downloadXlsx(): StreamedResponse
    {
        $filename = 'data-kendaraan-'.date('Y-m-d-His').'.xlsx';

        return response()->streamDownload(function (): void {
            $spreadsheet = $this->buildSpreadsheet();

            (new Xlsx($spreadsheet))->save('php://output');
            $spreadsheet->disconnectWorksheets();
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function downloadCsv(): StreamedResponse
    {
        $filename = 'data-kendaraan-'.date('Y-m-d-His').'.csv';

        return response()->streamDownload(function (): void {
            $spreadsheet = $this->buildSpreadsheet();
            $writer = new Csv($spreadsheet);
            $writer->setDelimiter(',');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setUseBOM(true);
            $writer->save('php://output');
            $spreadsheet->disconnectWorksheets();
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
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
            'Sumber Kendaraan',
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
                $v->sumber_kendaraan,
                $v->anggaran_biaya,
                $v->biaya_plat_stnk,
                $v->keterangan_pajak ?? '',
                $v->keterangan_kendaraan ?? '',
            ];

            $colIndex = 1;
            foreach ($data as $value) {
                $cell = $sheet->getCell(Coordinate::stringFromColumnIndex($colIndex).$row);
                $cell->setValue($this->spreadsheetValue($value));

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

    private function spreadsheetValue(mixed $value): mixed
    {
        if (is_string($value) && preg_match('/^[=+\-@]/', $value) === 1) {
            return "'".$value;
        }

        return $value;
    }
}
