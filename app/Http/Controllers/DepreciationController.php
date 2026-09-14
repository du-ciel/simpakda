<?php

namespace App\Http\Controllers;

use App\Exports\DepreciationExport;
use App\Models\Depreciation;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DepreciationController extends Controller
{
    /**
     * Menampilkan daftar penyusutan kendaraan.
     */
    public function index(Request $request)
    {
        // =========================================================
        // QUERY DASAR
        // =========================================================

        $query = Vehicle::with('depreciation');

        // Terapkan filter.
        $this->applyFilters($query, $request);

        // =========================================================
        // URUTAN DATA
        // =========================================================

        $query
            ->orderBy('tahun_pemakaian')
            ->orderBy('merek');

        $tahunSekarang = now()->year;

        // =========================================================
        // ATURAN PENYUSUTAN
        // =========================================================

        $aturanPenyusutan = [
            1 => [
                'masa_manfaat' => 10,
                'tarif' => 0.0625,
                'tarif_persen' => 6.25,
            ],

            2 => [
                'masa_manfaat' => 10,
                'tarif' => 0.015625,
                'tarif_persen' => 1.5625,
            ],
        ];

        // =========================================================
        // DATA LENGKAP HASIL FILTER
        // =========================================================
        //
        // Digunakan untuk menghitung total seluruh data hasil filter,
        // bukan hanya data pada halaman aktif.
        //
        $allVehicles = (clone $query)->get();

        // =========================================================
        // TOTAL KESELURUHAN
        // =========================================================

        $totalNilaiPerolehan = 0;
        $totalPenyusutan = 0;
        $totalNilaiBuku = 0;
        $totalPenyusutanTahunan = 0;

        $allVehicles->transform(
            function (Vehicle $vehicle) use (
                $tahunSekarang,
                &$totalNilaiPerolehan,
                &$totalPenyusutan,
                &$totalNilaiBuku,
                &$totalPenyusutanTahunan
            ) {
                $vehicle = $this->hitungPenyusutan(
                    $vehicle,
                    $tahunSekarang
                );

                $totalNilaiPerolehan += (float) (
                    $vehicle->nilai_perolehan_hitung ?? 0
                );

                $totalPenyusutan += (float) (
                    $vehicle->akumulasi_penyusutan_hitung ?? 0
                );

                $totalNilaiBuku += (float) (
                    $vehicle->nilai_buku_hitung ?? 0
                );

                $totalPenyusutanTahunan += (float) (
                    $vehicle->penyusutan_tahunan_hitung ?? 0
                );

                return $vehicle;
            }
        );

        // =========================================================
        // PAGINATION
        // =========================================================
        //
        // 15 kendaraan per halaman.
        //
        // withQueryString() menjaga filter tetap terbawa:
        //
        // ?sumber_kendaraan=APBD&kategori=Mobil&page=2
        //
        $vehicles = $query
            ->paginate(15)
            ->withQueryString();

        // =========================================================
        // HITUNG PENYUSUTAN PADA HALAMAN AKTIF
        // =========================================================

        $vehicles->getCollection()->transform(
            function (Vehicle $vehicle) use ($tahunSekarang) {
                return $this->hitungPenyusutan(
                    $vehicle,
                    $tahunSekarang
                );
            }
        );

        // =========================================================
        // DATA FILTER
        // =========================================================

        $sumberList = Vehicle::query()
            ->whereNotNull('sumber_kendaraan')
            ->where('sumber_kendaraan', '!=', '')
            ->distinct()
            ->orderBy('sumber_kendaraan')
            ->pluck('sumber_kendaraan');

        $kategoriList = Vehicle::query()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $tahunList = Vehicle::query()
            ->whereNotNull('tahun_pemakaian')
            ->distinct()
            ->orderByDesc('tahun_pemakaian')
            ->pluck('tahun_pemakaian');

        // =========================================================
        // VIEW
        // =========================================================

        return view('depreciation.index', compact(
            'vehicles',
            'tahunSekarang',
            'totalNilaiPerolehan',
            'totalPenyusutan',
            'totalNilaiBuku',
            'totalPenyusutanTahunan',
            'sumberList',
            'kategoriList',
            'tahunList',
            'aturanPenyusutan'
        ));
    }

    /**
     * Terapkan filter kendaraan.
     */
    private function applyFilters(
        Builder $query,
        Request $request
    ): void {
        $query->when(
            $request->filled('sumber_kendaraan'),
            function (Builder $query) use ($request) {
                $query->where(
                    'sumber_kendaraan',
                    $request->input('sumber_kendaraan')
                );
            }
        );

        $query->when(
            $request->filled('kategori'),
            function (Builder $query) use ($request) {
                $query->where(
                    'kategori',
                    $request->input('kategori')
                );
            }
        );

        $query->when(
            $request->filled('tahun_pemakaian'),
            function (Builder $query) use ($request) {
                $query->where(
                    'tahun_pemakaian',
                    $request->input('tahun_pemakaian')
                );
            }
        );
    }

    /**
     * Export data penyusutan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        $query = Vehicle::with('depreciation');

        $this->applyFilters($query, $request);

        $query
            ->orderBy('tahun_pemakaian')
            ->orderBy('merek');

        $tahunSekarang = now()->year;

        $vehicles = $query->get();

        $vehicles->transform(
            function (Vehicle $vehicle) use ($tahunSekarang) {
                return $this->hitungPenyusutan(
                    $vehicle,
                    $tahunSekarang
                );
            }
        );

        return (new DepreciationExport(
            $vehicles->all()
        ))->downloadXlsx();
    }

    /**
     * Menampilkan form edit penyusutan kendaraan.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicle->load('depreciation');

        $aturanPenyusutan = [
            1 => [
                'masa_manfaat' => 10,
                'tarif_persen' => 6.25,
            ],

            2 => [
                'masa_manfaat' => 10,
                'tarif_persen' => 1.5625,
            ],
        ];

        return view(
            'depreciation.edit',
            compact(
                'vehicle',
                'aturanPenyusutan'
            )
        )->with(
            'returnQuery',
            request()->query()
        );
    }

    /**
     * Menyimpan perubahan data penyusutan.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        // =========================================================
        // NORMALISASI NILAI PEROLEHAN
        // =========================================================

        $nilaiPerolehan = $request->input('nilai_perolehan');

        if (is_string($nilaiPerolehan)) {
            $nilaiPerolehan = trim($nilaiPerolehan);

            if (str_contains($nilaiPerolehan, ',')) {
                // Contoh: 12.300.000,50
                $nilaiPerolehan = str_replace(
                    '.',
                    '',
                    $nilaiPerolehan
                );

                $nilaiPerolehan = str_replace(
                    ',',
                    '.',
                    $nilaiPerolehan
                );
            } else {
                // Contoh: 12.300.000
                if (
                    preg_match(
                        '/^\d{1,3}(\.\d{3})+$/',
                        $nilaiPerolehan
                    )
                ) {
                    $nilaiPerolehan = str_replace(
                        '.',
                        '',
                        $nilaiPerolehan
                    );
                }
            }
        }

        // =========================================================
        // NORMALISASI TARIF
        // =========================================================

        $tarifPenyusutan = $request->input(
            'tarif_penyusutan'
        );

        if (is_string($tarifPenyusutan)) {
            $tarifPenyusutan = trim($tarifPenyusutan);

            $tarifPenyusutan = str_replace(
                ',',
                '.',
                $tarifPenyusutan
            );
        }

        // =========================================================
        // MERGE DATA DINORMALISASI KE REQUEST SEBELUM VALIDASI
        // =========================================================

        $request->merge([
            'nilai_perolehan' => $nilaiPerolehan,
            'tarif_penyusutan' => $tarifPenyusutan,
        ]);

        // =========================================================
        // VALIDASI
        // =========================================================

        $validated = $request->validate([
            'nilai_perolehan' => [
                'required',
                'numeric',
                'min:0',
            ],

            'tahun_perolehan' => [
                'required',
                'integer',
                'min:1900',
                'max:' . now()->year,
            ],

            'kelompok_penyusutan' => [
                'required',
                'integer',
                'in:1,2',
            ],

            'masa_manfaat' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],

            'tarif_penyusutan' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'metode_penyusutan' => [
                'required',
                'in:garis_lurus',
            ],
        ]);

        $validated['nilai_perolehan'] = $nilaiPerolehan;
        $validated['tarif_penyusutan'] = $tarifPenyusutan;

        // =========================================================
        // ATURAN PENYUSUTAN
        // =========================================================

        $aturanPenyusutan = [
            1 => [
                'masa_manfaat' => 10,
                'tarif_persen' => 6.25,
            ],

            2 => [
                'masa_manfaat' => 10,
                'tarif_persen' => 1.5625,
            ],
        ];

        $kelompok = (int) $validated['kelompok_penyusutan'];

        // Jangan mempercayai masa manfaat/tarif dari browser.
        $validated['masa_manfaat'] =
            $aturanPenyusutan[$kelompok]['masa_manfaat'];

        $validated['tarif_penyusutan'] =
            $aturanPenyusutan[$kelompok]['tarif_persen'];

        // =========================================================
        // SIMPAN
        // =========================================================

        Depreciation::updateOrCreate(
            [
                'vehicle_id' => $vehicle->id,
            ],
            [
                'nilai_perolehan' =>
                    $validated['nilai_perolehan'],

                'tahun_perolehan' =>
                    $validated['tahun_perolehan'],

                'kelompok_penyusutan' =>
                    $validated['kelompok_penyusutan'],

                'masa_manfaat' =>
                    $validated['masa_manfaat'],

                'tarif_penyusutan' =>
                    $validated['tarif_penyusutan'],

                'metode_penyusutan' =>
                    $validated['metode_penyusutan'],
            ]
        );

        // =========================================================
        // KEMBALI KE HALAMAN SEBELUMNYA
        // =========================================================

        $returnQuery = array_filter(
            [
                'page' =>
                    $request->input('return_page'),

                'sumber_kendaraan' =>
                    $request->input(
                        'return_sumber_kendaraan'
                    ),

                'kategori' =>
                    $request->input(
                        'return_kategori'
                    ),

                'tahun_pemakaian' =>
                    $request->input(
                        'return_tahun_pemakaian'
                    ),
            ],
            function ($value) {
                return $value !== null
                    && $value !== '';
            }
        );

        return redirect()
            ->route(
                'penyusutan.index',
                $returnQuery
            )
            ->with(
                'success',
                'Data penyusutan kendaraan berhasil diperbarui.'
            );
    }

    /**
     * Menghitung penyusutan kendaraan.
     */
    private function hitungPenyusutan(
        Vehicle $vehicle,
        int $tahunSekarang
    ): Vehicle {
        $depreciation = $vehicle->depreciation;

        if (!$depreciation) {
            $vehicle->nilai_perolehan_hitung = 0;
            $vehicle->umur_aset_hitung = 0;
            $vehicle->masa_manfaat_hitung = null;
            $vehicle->tarif_penyusutan_hitung = 0;
            $vehicle->penyusutan_tahunan_hitung = 0;
            $vehicle->akumulasi_penyusutan_hitung = 0;
            $vehicle->nilai_buku_hitung = 0;
            $vehicle->status_penyusutan_hitung =
                'Belum Ada Data Penyusutan';

            return $vehicle;
        }

        $nilaiPerolehan =
            (float) ($depreciation->nilai_perolehan ?? 0);

        $tahunPerolehan =
            (int) ($depreciation->tahun_perolehan ?? 0);

        $kelompok =
            (int) ($depreciation->kelompok_penyusutan ?? 0);

        // =========================================================
        // ATURAN BERDASARKAN KELOMPOK
        // =========================================================

        if ($kelompok === 1) {
            $masaManfaat = 10;
            $tarifPersen = 6.25;
        } elseif ($kelompok === 2) {
            $masaManfaat = 8;
            $tarifPersen = 1.5625;
        } else {
            $masaManfaat = 0;
            $tarifPersen = 0;
        }

        $tarif = $tarifPersen / 100;

        // =========================================================
        // UMUR ASET
        // =========================================================

        if ($tahunPerolehan > 0) {
            $umurAset = max(
                0,
                $tahunSekarang - $tahunPerolehan
            );
        } else {
            $umurAset = 0;
        }

        // =========================================================
        // PENYUSUTAN TAHUNAN
        // =========================================================

        $penyusutanTahunan =
            $nilaiPerolehan * $tarif;

        // =========================================================
        // TAHUN YANG SUDAH DISUSUTKAN
        // =========================================================

        if ($masaManfaat > 0) {
            $tahunDisusutkan = min(
                $umurAset,
                $masaManfaat,
                10
            );
        } else {
            $tahunDisusutkan = 0;
        }

        // =========================================================
        // AKUMULASI PENYUSUTAN
        // =========================================================

        $akumulasiPenyusutan =
            $penyusutanTahunan * $tahunDisusutkan;

        $akumulasiPenyusutan = min(
            $akumulasiPenyusutan,
            $nilaiPerolehan
        );

        // =========================================================
        // NILAI BUKU
        // =========================================================

        $nilaiBuku = max(
            0,
            $nilaiPerolehan - $akumulasiPenyusutan
        );

        // =========================================================
        // STATUS
        // =========================================================

        if ($nilaiPerolehan <= 0) {
            $statusPenyusutan =
                'Tidak Ada Nilai Perolehan';
        } elseif ($tahunPerolehan <= 0) {
            $statusPenyusutan =
                'Tahun Perolehan Tidak Valid';
        } elseif ($masaManfaat <= 0) {
            $statusPenyusutan =
                'Masa Manfaat Tidak Valid';
        } elseif ($umurAset >= 10) {
            $statusPenyusutan =
                'Penyusutan Maksimal';
        } elseif ($umurAset <= 0) {
            $statusPenyusutan =
                'Belum Mulai Penyusutan';
        } else {
            $statusPenyusutan =
                'Dalam Penyusutan';
        }

        // =========================================================
        // HASIL PERHITUNGAN
        // =========================================================

        $vehicle->nilai_perolehan_hitung =
            $nilaiPerolehan;

        $vehicle->umur_aset_hitung =
            $umurAset;

        $vehicle->masa_manfaat_hitung =
            $masaManfaat;

        $vehicle->tarif_penyusutan_hitung =
            $tarifPersen;

        $vehicle->penyusutan_tahunan_hitung =
            $penyusutanTahunan;

        $vehicle->akumulasi_penyusutan_hitung =
            $akumulasiPenyusutan;

        $vehicle->nilai_buku_hitung =
            $nilaiBuku;

        $vehicle->status_penyusutan_hitung =
            $statusPenyusutan;

        $vehicle->tahun_disusutkan_hitung =
            $tahunDisusutkan;

        return $vehicle;
    }
}