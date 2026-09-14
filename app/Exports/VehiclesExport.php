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
            if (ob_get_level() > 0) {
                ob_end_clean();
            }

            $spreadsheet = $this->buildSpreadsheet();

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            $spreadsheet->disconnectWorksheets();
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function downloadCsv(): StreamedResponse
    {
        $filename = 'data-kendaraan-'.date('Y-m-d-His').'.csv';

        return response()->streamDownload(function (): void {
            if (ob_get_level() > 0) {
                ob_end_clean();
            }

            $handle = fopen('php://output', 'w');

            // UTF-8 BOM agar Microsoft Excel membuka karakter dengan benar di Windows
            fputs($handle, "\xEF\xBB\xBF");

            // Header kolom
            fputcsv($handle, [
                'No',
                'Merek',
                'No Polisi',
                'Tipe',
                'No Chasis',
                'No Mesin',
                'Tahun Pemakaian',
                'Masa Berlaku Pajak Tahunan',
                'Masa Berlaku STNK',
                'Bahan Bakar',
                'Nama Pemakai',
                'Jabatan',
                'Keterangan Kendaraan',
                'Sumber',
                'Anggaran',
            ]);

            $no = 1;
            foreach ($this->vehicles as $v) {
                fputcsv($handle, [
                    $no++,
                    $v->merek ?? '-',
                    $v->nomor_polisi ?? '-',
                    $v->tipe ?? '-',
                    $v->nomor_chasis ?? '-',
                    $v->nomor_mesin ?? '-',
                    $v->tahun_pemakaian ?? '-',
                    $v->masa_berlaku_pajak?->format('d/m/Y') ?? '-',
                    $v->masa_berlaku_stnk?->format('d/m/Y') ?? '-',
                    $v->bahan_bakar ?? '-',
                    $v->nama_pemakai ?? '-',
                    $v->jabatan_pemakai ?? '-',
                    $v->keterangan_kendaraan ?? '-',
                    $v->sumber_kendaraan ?? '-',
                    $v->anggaran_biaya ?? '-',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    protected function buildSpreadsheet(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Urutan header tabel
        $headers = [
            'No',
            'Merek',
            'No Polisi',
            'Tipe',
            'No Chasis',
            'No Mesin',
            'Tahun Pemakaian',
            'Masa Berlaku Pajak Tahunan',
            'Masa Berlaku STNK',
            'Bahan Bakar',
            'Nama Pemakai',
            'Jabatan',
            'Keterangan Kendaraan',
            'Sumber',
            'Anggaran',
        ];

        // Mendapatkan huruf kolom terakhir secara otomatis
        $highestColumn = Coordinate::stringFromColumnIndex(count($headers));
        
        // Atur filter dinamis
        $sheet->setAutoFilter('A1:' . $highestColumn . '1');
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
            // Urutan Data (null-safe)
            $data = [
                $no,
                $v->merek ?? '-',
                $v->nomor_polisi ?? '-',
                $v->tipe ?? '-',
                $v->nomor_chasis ?? '-',
                $v->nomor_mesin ?? '-',
                $v->tahun_pemakaian ?? '-',
                $v->masa_berlaku_pajak?->format('d/m/Y') ?? '-',
                $v->masa_berlaku_stnk?->format('d/m/Y') ?? '-',
                $v->bahan_bakar ?? '-',
                $v->nama_pemakai ?? '-',
                $v->jabatan_pemakai ?? '-',
                $v->keterangan_kendaraan ?? '-',
                $v->sumber_kendaraan ?? '-',
                $v->anggaran_biaya ?? '-',
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

        // 3. AUTOSIZE KOLOM DINAMIS
        foreach (range('A', $highestColumn) as $col) {
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