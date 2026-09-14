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

class DepreciationExport
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

    /**
     * Download Excel XLSX.
     */
    public function downloadXlsx(): StreamedResponse
    {
        $filename = 'penyusutan-kendaraan-' . date('Y-m-d-His') . '.xlsx';

        return response()->streamDownload(function (): void {

            $spreadsheet = $this->buildSpreadsheet();

            (new Xlsx($spreadsheet))->save('php://output');

            $spreadsheet->disconnectWorksheets();

        }, $filename, [
            'Content-Type' =>
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Download CSV.
     */
    public function downloadCsv(): StreamedResponse
    {
        $filename = 'penyusutan-kendaraan-' . date('Y-m-d-His') . '.csv';

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

    /**
     * Membuat spreadsheet penyusutan kendaraan.
     */
    protected function buildSpreadsheet(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Penyusutan Kendaraan');

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        $headers = [
            'No',
            'No Polisi',
            'Merek',
            'Tipe',
            'Jenis',
            'Kategori',
            'Tahun Perolehan',
            'Kelompok Penyusutan',
            'Masa Manfaat',
            'Umur Aset',
            'Tarif Penyusutan',
            'Nilai Perolehan',
            'Penyusutan / Tahun',
            'Akumulasi Penyusutan',
            'Nilai Buku',
            'Status Penyusutan',
        ];

        $highestColumn = Coordinate::stringFromColumnIndex(
            count($headers)
        );

        /*
        |--------------------------------------------------------------------------
        | FILTER HEADER
        |--------------------------------------------------------------------------
        */

        $sheet->setAutoFilter(
            'A1:' . $highestColumn . '1'
        );

        $sheet->getRowDimension(1)->setRowHeight(30);

        /*
        |--------------------------------------------------------------------------
        | HEADER STYLE
        |--------------------------------------------------------------------------
        */

        $colIndex = 1;

        foreach ($headers as $header) {

            $column = Coordinate::stringFromColumnIndex(
                $colIndex
            );

            $cell = $sheet->getCell(
                $column . '1'
            );

            $cell->setValue($header);

            $cell->getStyle()->applyFromArray([

                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '0D9488',
                    ],
                ],

                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],

                'alignment' => [
                    'horizontal' =>
                        Alignment::HORIZONTAL_CENTER,

                    'vertical' =>
                        Alignment::VERTICAL_CENTER,

                    'wrapText' => true,
                ],

                'borders' => [
                    'allBorders' => [
                        'borderStyle' =>
                            Border::BORDER_THIN,

                        'color' => [
                            'rgb' => '0F766E',
                        ],
                    ],
                ],
            ]);

            $colIndex++;
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $no = 1;
        $row = 2;

        foreach ($this->vehicles as $vehicle) {

            $sheet->getRowDimension($row)->setRowHeight(20);

            /*
            |--------------------------------------------------------------------------
            | DATA PENYUSUTAN
            |--------------------------------------------------------------------------
            |
            | Mengambil nilai dari properti hasil perhitungan
            | DepreciationController.
            |
            */

            $nilaiPerolehan =
                (float) (
                    $vehicle->nilai_perolehan_hitung ?? 0
                );

            $umurAset =
                (int) (
                    $vehicle->umur_aset_hitung ?? 0
                );

            $masaManfaat =
                $vehicle->masa_manfaat_hitung;

            $tarifPenyusutan =
                (float) (
                    $vehicle->tarif_penyusutan_hitung ?? 0
                );

            $penyusutanTahunan =
                (float) (
                    $vehicle->penyusutan_tahunan_hitung ?? 0
                );

            $akumulasiPenyusutan =
                (float) (
                    $vehicle->akumulasi_penyusutan_hitung ?? 0
                );

            $nilaiBuku =
                (float) (
                    $vehicle->nilai_buku_hitung ?? 0
                );

            $statusPenyusutan =
                $vehicle->status_penyusutan_hitung
                ?? 'Belum Ada Data Penyusutan';

            /*
            |--------------------------------------------------------------------------
            | RELASI DEPRESIASI
            |--------------------------------------------------------------------------
            */

            $depreciation =
                $vehicle->depreciation;

            $tahunPerolehan =
                $depreciation?->tahun_perolehan;

            $kelompok =
                (int) (
                    $depreciation?->kelompok_penyusutan ?? 0
                );

            /*
            |--------------------------------------------------------------------------
            | LABEL KELOMPOK
            |--------------------------------------------------------------------------
            */

            if ($kelompok === 1) {

                $kelompokLabel =
                    'Kelompok 1 - Motor';

            } elseif ($kelompok === 2) {

                $kelompokLabel =
                    'Kelompok 2 - Mobil';

            } else {

                $kelompokLabel =
                    'Belum diatur';
            }

            /*
            |--------------------------------------------------------------------------
            | DATA EXCEL
            |--------------------------------------------------------------------------
            */

            $data = [

                $no,

                $vehicle->nomor_polisi
                    ?? '-',

                $vehicle->merek
                    ?? '-',

                $vehicle->tipe
                    ?? '-',

                $vehicle->jenis
                    ?? '-',

                $vehicle->kategori
                    ?? '-',

                $tahunPerolehan
                    ?? '-',

                $kelompokLabel,

                $masaManfaat !== null
                    ? $masaManfaat . ' Tahun'
                    : '-',

                $umurAset . ' Tahun',

                $tarifPenyusutan,

                $nilaiPerolehan,

                $penyusutanTahunan,

                $akumulasiPenyusutan,

                $nilaiBuku,

                $statusPenyusutan,
            ];

            /*
            |--------------------------------------------------------------------------
            | WRITE DATA
            |--------------------------------------------------------------------------
            */

            $colIndex = 1;

            foreach ($data as $value) {

                $column =
                    Coordinate::stringFromColumnIndex(
                        $colIndex
                    );

                $cell =
                    $sheet->getCell(
                        $column . $row
                    );

                $cell->setValue(
                    $this->spreadsheetValue($value)
                );

                /*
                |--------------------------------------------------------------------------
                | DEFAULT STYLE
                |--------------------------------------------------------------------------
                */

                $cell->getStyle()->applyFromArray([

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' =>
                                Border::BORDER_THIN,

                            'color' => [
                                'rgb' => 'E2E8F0',
                            ],
                        ],
                    ],

                    'alignment' => [
                        'vertical' =>
                            Alignment::VERTICAL_CENTER,
                    ],
                ]);

                /*
                |--------------------------------------------------------------------------
                | NOMOR
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 1) {

                    $cell->getStyle()->applyFromArray([
                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                            'vertical' =>
                                Alignment::VERTICAL_CENTER,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | TAHUN
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 7) {

                    $cell->getStyle()->applyFromArray([
                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | KELOMPOK
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 8) {

                    $groupColor = match ($kelompok) {
                        1 => '2563EB',
                        2 => '7C3AED',
                        default => '64748B',
                    };

                    $cell->getStyle()->applyFromArray([

                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => $groupColor,
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                            'vertical' =>
                                Alignment::VERTICAL_CENTER,

                            'wrapText' => true,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | MASA MANFAAT
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 9) {

                    $cell->getStyle()->applyFromArray([
                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | UMUR ASET
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 10) {

                    $cell->getStyle()->applyFromArray([
                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | TARIF
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 11) {

                    $cell->getStyle()->applyFromArray([

                        'numberFormat' => [
                            'formatCode' =>
                                '0.0000"%"',
                        ],

                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => 'B45309',
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | NILAI PEROLEHAN
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 12) {

                    $cell->getStyle()->applyFromArray([

                        'numberFormat' => [
                            'formatCode' =>
                                '#,##0.00',
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_RIGHT,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | PENYUSUTAN / TAHUN
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 13) {

                    $cell->getStyle()->applyFromArray([

                        'numberFormat' => [
                            'formatCode' =>
                                '#,##0.00',
                        ],

                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => 'B45309',
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_RIGHT,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | AKUMULASI
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 14) {

                    $cell->getStyle()->applyFromArray([

                        'numberFormat' => [
                            'formatCode' =>
                                '#,##0.00',
                        ],

                        'font' => [
                            'color' => [
                                'rgb' => 'B45309',
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_RIGHT,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | NILAI BUKU
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 15) {

                    $cell->getStyle()->applyFromArray([

                        'numberFormat' => [
                            'formatCode' =>
                                '#,##0.00',
                        ],

                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => '047857',
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_RIGHT,
                        ],
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                if ($colIndex === 16) {

                    $fontColor = match (
                        trim((string) $statusPenyusutan)
                    ) {

                        'Penyusutan Maksimal'
                            => '047857',

                        'Dalam Penyusutan'
                            => '2563EB',

                        'Belum Mulai Penyusutan'
                            => 'D97706',

                        'Tidak Ada Nilai Perolehan',
                        'Tahun Perolehan Tidak Valid',
                        'Masa Manfaat Tidak Valid'
                            => 'DC2626',

                        'Belum Ada Data Penyusutan'
                            => '64748B',

                        default
                            => '475569',
                    };

                    $cell->getStyle()->applyFromArray([

                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => $fontColor,
                            ],
                        ],

                        'alignment' => [
                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                            'vertical' =>
                                Alignment::VERTICAL_CENTER,

                            'wrapText' => true,
                        ],
                    ]);
                }

                $colIndex++;
            }

            $no++;
            $row++;
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        if ($row > 2) {

            $totalRow = $row;

            $sheet->getRowDimension(
                $totalRow
            )->setRowHeight(24);

            /*
            |--------------------------------------------------------------------------
            | HITUNG TOTAL
            |--------------------------------------------------------------------------
            */

            $totalNilaiPerolehan = 0;
            $totalPenyusutanTahunan = 0;
            $totalAkumulasiPenyusutan = 0;
            $totalNilaiBuku = 0;

            foreach ($this->vehicles as $vehicle) {

                $totalNilaiPerolehan +=
                    (float) (
                        $vehicle->nilai_perolehan_hitung
                        ?? 0
                    );

                $totalPenyusutanTahunan +=
                    (float) (
                        $vehicle->penyusutan_tahunan_hitung
                        ?? 0
                    );

                $totalAkumulasiPenyusutan +=
                    (float) (
                        $vehicle->akumulasi_penyusutan_hitung
                        ?? 0
                    );

                $totalNilaiBuku +=
                    (float) (
                        $vehicle->nilai_buku_hitung
                        ?? 0
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL LABEL
            |--------------------------------------------------------------------------
            */

            $sheet->mergeCells(
                'A' . $totalRow . ':K' . $totalRow
            );

            $sheet->setCellValue(
                'A' . $totalRow,
                'TOTAL'
            );

            /*
            |--------------------------------------------------------------------------
            | TOTAL NILAI
            |--------------------------------------------------------------------------
            */

            $sheet->setCellValue(
                'L' . $totalRow,
                $totalNilaiPerolehan
            );

            $sheet->setCellValue(
                'M' . $totalRow,
                $totalPenyusutanTahunan
            );

            $sheet->setCellValue(
                'N' . $totalRow,
                $totalAkumulasiPenyusutan
            );

            $sheet->setCellValue(
                'O' . $totalRow,
                $totalNilaiBuku
            );

            /*
            |--------------------------------------------------------------------------
            | STYLE TOTAL
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle(
                'A' . $totalRow .
                ':' .
                $highestColumn . $totalRow
            )->applyFromArray([

                'fill' => [
                    'fillType' =>
                        Fill::FILL_SOLID,

                    'startColor' => [
                        'rgb' => 'F1F5F9',
                    ],
                ],

                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => '0F172A',
                    ],
                ],

                'borders' => [
                    'top' => [
                        'borderStyle' =>
                            Border::BORDER_MEDIUM,

                        'color' => [
                            'rgb' => '94A3B8',
                        ],
                    ],

                    'bottom' => [
                        'borderStyle' =>
                            Border::BORDER_THIN,

                        'color' => [
                            'rgb' => 'CBD5E1',
                        ],
                    ],
                ],

                'alignment' => [
                    'vertical' =>
                        Alignment::VERTICAL_CENTER,
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | FORMAT TOTAL
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle(
                'L' . $totalRow . ':O' . $totalRow
            )
                ->getNumberFormat()
                ->setFormatCode('#,##0.00');

            $sheet->getStyle(
                'L' . $totalRow . ':O' . $totalRow
            )
                ->getAlignment()
                ->setHorizontal(
                    Alignment::HORIZONTAL_RIGHT
                );

            $sheet->getCell(
                'A' . $totalRow
            )
                ->getStyle()
                ->getAlignment()
                ->setHorizontal(
                    Alignment::HORIZONTAL_RIGHT
                );
        }

        /*
        |--------------------------------------------------------------------------
        | FORMAT ANGKA DATA
        |--------------------------------------------------------------------------
        */

        if ($row > 2) {

            $sheet->getStyle(
                'L2:O' . ($row - 1)
            )
                ->getNumberFormat()
                ->setFormatCode('#,##0.00');
        }

        /*
        |--------------------------------------------------------------------------
        | LEBAR KOLOM
        |--------------------------------------------------------------------------
        */

        $widths = [

            'A' => 7,
            'B' => 16,
            'C' => 20,
            'D' => 22,
            'E' => 16,
            'F' => 18,
            'G' => 17,
            'H' => 23,
            'I' => 16,
            'J' => 14,
            'K' => 18,
            'L' => 20,
            'M' => 22,
            'N' => 24,
            'O' => 20,
            'P' => 28,

        ];

        foreach ($widths as $column => $width) {

            $sheet
                ->getColumnDimension($column)
                ->setWidth($width);
        }

        /*
        |--------------------------------------------------------------------------
        | FREEZE HEADER
        |--------------------------------------------------------------------------
        */

        $sheet->freezePane('A2');

        /*
        |--------------------------------------------------------------------------
        | PRINT SETTING
        |--------------------------------------------------------------------------
        */

        $sheet->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->getPageSetup()
            ->setPaperSize(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4
            );

        $sheet->getPageSetup()
            ->setFitToWidth(1);

        $sheet->getPageSetup()
            ->setFitToHeight(0);

        $sheet->getPageMargins()
            ->setTop(0.5)
            ->setRight(0.3)
            ->setLeft(0.3)
            ->setBottom(0.5);

        return $spreadsheet;
    }

    /**
     * Mencegah formula injection pada Excel / CSV.
     */
    private function spreadsheetValue(mixed $value): mixed
    {
        if (
            is_string($value)
            && preg_match(
                '/^[=+\-@]/',
                $value
            ) === 1
        ) {
            return "'" . $value;
        }

        return $value;
    }
}