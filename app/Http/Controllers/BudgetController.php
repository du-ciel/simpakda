<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Menampilkan halaman anggaran.
     */
    public function index(Request $request): View
    {
        $query = Vehicle::query();

        // Terapkan filter
        $this->applyFilters($query, $request);

        $vehicles = $query
            ->orderBy('merek')
            ->get();

        // =========================
        // TOTAL
        // =========================

        $totalKendaraan = $vehicles->count();

        $totalAnggaran = $vehicles->sum(
            'anggaran_biaya'
        );

        $totalPlatStnk = $vehicles->sum(
            'biaya_plat_stnk'
        );

        $totalBiaya =
            $totalAnggaran +
            $totalPlatStnk;

        // =========================
        // DATA FILTER
        // =========================

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

        return view('budget.index', compact(
            'vehicles',
            'totalKendaraan',
            'totalAnggaran',
            'totalPlatStnk',
            'totalBiaya',
            'sumberList',
            'kategoriList',
        ));
    }

    /**
     * Export laporan anggaran ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $query = Vehicle::query();

        // Gunakan filter yang sama dengan halaman anggaran
        $this->applyFilters($query, $request);

        $vehicles = $query
            ->orderBy('merek')
            ->get();

        // =========================
        // TOTAL
        // =========================

        $totalKendaraan = $vehicles->count();

        $totalAnggaran = $vehicles->sum(
            'anggaran_biaya'
        );

        $totalPlatStnk = $vehicles->sum(
            'biaya_plat_stnk'
        );

        $totalBiaya =
            $totalAnggaran +
            $totalPlatStnk;

        // =========================
        // INFORMASI FILTER
        // =========================

        $filterSumber = $request->input('sumber');

        $filterKategori = $request->input('kategori');

        // =========================
        // GENERATE PDF
        // =========================

        $pdf = Pdf::loadView(
            'budget.export-pdf',
            [
                'vehicles' => $vehicles,

                'totalKendaraan' => $totalKendaraan,

                'totalAnggaran' => $totalAnggaran,

                'totalPlatStnk' => $totalPlatStnk,

                'totalBiaya' => $totalBiaya,

                'filterSumber' => $filterSumber,

                'filterKategori' => $filterKategori,

                'printedAt' => now()->format('d/m/Y H:i'),
            ]
        );

        // A4 Landscape seperti export Vehicles
        $pdf->setPaper(
            'A4',
            'landscape'
        );

        return $pdf->download(
            'laporan-anggaran-kendaraan-' .
            now()->format('Y-m-d-His') .
            '.pdf'
        );
    }

    /**
     * Terapkan filter anggaran.
     */
    private function applyFilters(
        Builder $query,
        Request $request
    ): void {
        // =========================
        // FILTER SUMBER
        // =========================

        if ($request->filled('sumber')) {
            $query->where(
                'sumber_kendaraan',
                $request->input('sumber')
            );
        }

        // =========================
        // FILTER KATEGORI
        // =========================

        if ($request->filled('kategori')) {
            $query->where(
                'kategori',
                $request->input('kategori')
            );
        }
    }
}