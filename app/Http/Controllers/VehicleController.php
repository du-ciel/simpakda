<?php

namespace App\Http\Controllers;

use App\Exports\VehiclesExport;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Menampilkan daftar kendaraan.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Terapkan seluruh filter berdasarkan query parameter URL.
        $this->applyFilters($query, $request);

        /*
         * Pagination.
         *
         * withQueryString() memastikan:
         *
         * /vehicles?kategori=roda_2&page=2
         *
         * tetap membawa kategori saat pindah halaman.
         */
        $vehicles = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        /*
         * Data dropdown kategori.
         */
        $kategoriList = Vehicle::query()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        /*
         * Data dropdown sumber kendaraan.
         */
        $sumberList = Vehicle::query()
            ->whereNotNull('sumber_kendaraan')
            ->where('sumber_kendaraan', '!=', '')
            ->distinct()
            ->orderBy('sumber_kendaraan')
            ->pluck('sumber_kendaraan');

        /*
         * Data dropdown tahun.
         */
        $tahunList = Vehicle::query()
            ->whereNotNull('tahun_pemakaian')
            ->distinct()
            ->orderByDesc('tahun_pemakaian')
            ->pluck('tahun_pemakaian');

        return view('vehicles.index', [
            'vehicles' => $vehicles,
            'kategoriList' => $kategoriList,
            'sumberList' => $sumberList,
            'tahunList' => $tahunList,
        ]);
    }

    /**
     * Form tambah kendaraan.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Simpan kendaraan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'bahan_bakar' => 'nullable|string|max:50',

            'nomor_polisi' => 'required|string|max:20|unique:vehicles,nomor_polisi',
            'nomor_chasis' => 'required|string|max:50|unique:vehicles,nomor_chasis',
            'nomor_mesin' => 'required|string|max:50|unique:vehicles,nomor_mesin',

            'tahun_pemakaian' => 'required|digits:4|integer|min:1990|max:' . date('Y'),

            'masa_berlaku_pajak' => 'required|date',
            'masa_berlaku_stnk' => 'required|date',

            'nama_pemakai' => 'required|string|max:100',
            'jabatan_pemakai' => 'required|string|max:100',

            'keterangan_pajak' => 'nullable|string',
            'keterangan_kendaraan' => 'nullable|string',

            'anggaran_biaya' => 'nullable|numeric|min:0',
            'biaya_plat_stnk' => 'nullable|numeric|min:0',

            'sumber_kendaraan' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'sub_kategori' => 'nullable|string|max:50',

            'status' => 'required|in:aktif,non_aktif,perbaikan,dijual',
        ]);

        $validated['anggaran_biaya'] =
            $validated['anggaran_biaya'] ?? 0;

        $validated['biaya_plat_stnk'] =
            $validated['biaya_plat_stnk'] ?? 0;

        Vehicle::create($validated);

        return redirect()
            ->route('vehicles.index')
            ->with(
                'success',
                'Kendaraan berhasil ditambahkan.'
            );
    }

    /**
     * Detail kendaraan.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('histories.user');

        return view(
            'vehicles.show',
            compact('vehicle')
        );
    }

    /**
     * Form edit kendaraan.
     */
    public function edit(Vehicle $vehicle)
    {
        return view(
            'vehicles.edit',
            compact('vehicle')
        );
    }

    /**
     * Update kendaraan.
     */
    public function update(
        Request $request,
        Vehicle $vehicle
    ) {
        $validated = $request->validate([
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'bahan_bakar' => 'nullable|string|max:50',

            'nomor_polisi' =>
                'required|string|max:20|unique:vehicles,nomor_polisi,' .
                $vehicle->id,

            'nomor_chasis' =>
                'required|string|max:50|unique:vehicles,nomor_chasis,' .
                $vehicle->id,

            'nomor_mesin' =>
                'required|string|max:50|unique:vehicles,nomor_mesin,' .
                $vehicle->id,

            'tahun_pemakaian' =>
                'required|digits:4|integer|min:1990|max:' .
                date('Y'),

            'masa_berlaku_pajak' => 'required|date',
            'masa_berlaku_stnk' => 'required|date',

            'nama_pemakai' => 'required|string|max:100',
            'jabatan_pemakai' => 'required|string|max:100',

            'keterangan_pajak' => 'nullable|string',
            'keterangan_kendaraan' => 'nullable|string',

            'anggaran_biaya' => 'nullable|numeric|min:0',
            'biaya_plat_stnk' => 'nullable|numeric|min:0',

            'sumber_kendaraan' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'sub_kategori' => 'nullable|string|max:50',

            'status' =>
                'required|in:aktif,non_aktif,perbaikan,dijual',
        ]);

        $validated['anggaran_biaya'] =
            $validated['anggaran_biaya'] ?? 0;

        $validated['biaya_plat_stnk'] =
            $validated['biaya_plat_stnk'] ?? 0;

        /*
         * Jika tanggal pajak berubah,
         * reset waktu pembayaran pajak.
         */
        if (
            $vehicle->masa_berlaku_pajak?->format('Y-m-d')
            !== $validated['masa_berlaku_pajak']
        ) {
            $validated['pajak_dibayar_at'] = null;
        }

        $vehicle->update($validated);

        /*
         * Kembalikan filter + halaman dari halaman index.
         */
        $filters = $request->only([
            'search',
            'kategori',
            'status',
            'pajak_stnk',
            'sumber',
            'tahun',
            'page',
        ]);

        $filters = array_filter(
            $filters,
            fn ($value) =>
                $value !== null &&
                $value !== ''
        );

        return redirect()
            ->route(
                'vehicles.index',
                $filters
            )
            ->with(
                'success',
                'Kendaraan berhasil diupdate.'
            );
    }

    /**
     * Hapus kendaraan.
     */
    public function destroy(
        Request $request,
        Vehicle $vehicle
    ) {
        $vehicle->delete();

        /*
         * Pertahankan filter + halaman.
         */
        $filters = $request->only([
            'search',
            'kategori',
            'status',
            'pajak_stnk',
            'sumber',
            'tahun',
            'page',
        ]);

        $filters = array_filter(
            $filters,
            fn ($value) =>
                $value !== null &&
                $value !== ''
        );

        return redirect()
            ->route(
                'vehicles.index',
                $filters
            )
            ->with(
                'success',
                'Kendaraan berhasil dihapus.'
            );
    }

    /**
     * Menandai pajak sebagai sudah dibayar.
     */
    public function markTaxPaid(Vehicle $vehicle)
    {
        if (
            $vehicle->masa_berlaku_pajak->year
            > now()->year
        ) {
            return redirect()
                ->route('monitoring')
                ->with(
                    'success',
                    'Pajak kendaraan ' .
                    $vehicle->nomor_polisi .
                    ' sudah dijadwalkan sampai ' .
                    $vehicle->masa_berlaku_pajak
                        ->format('d/m/Y') .
                    '.'
                );
        }

        $nextTaxDueDate =
            $vehicle->masa_berlaku_pajak
                ->copy()
                ->addYearNoOverflow();

        $vehicle->update([
            'masa_berlaku_pajak' => $nextTaxDueDate,
            'pajak_dibayar_at' => now(),
        ]);

        return redirect()
            ->route('monitoring')
            ->with(
                'success',
                'Pajak kendaraan ' .
                $vehicle->nomor_polisi .
                ' sudah dibayar. Pengingat berikutnya: ' .
                $nextTaxDueDate->format('d/m/Y') .
                '.'
            );
    }

    /**
     * Export kendaraan.
     */
    public function export(Request $request)
    {
        $query = Vehicle::query();

        $this->applyFilters(
            $query,
            $request
        );

        $vehicles = $query
            ->orderByDesc('created_at')
            ->get();

        $format =
            $request->get(
                'format',
                'xlsx'
            );

        if ($format === 'csv') {
            return (new VehiclesExport(
                $vehicles->all()
            ))->downloadCsv();
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView(
                'vehicles.export-pdf',
                [
                    'vehicles' => $vehicles,
                    'printedAt' =>
                        now()->format('d/m/Y H:i'),
                ]
            );

            $pdf->setPaper(
                'A4',
                'landscape'
            );

            return $pdf->download(
                'data-kendaraan-' .
                date('Y-m-d-His') .
                '.pdf'
            );
        }

        return (new VehiclesExport(
            $vehicles->all()
        ))->downloadXlsx();
    }

    /**
     * Terapkan seluruh filter kendaraan.
     */
    private function applyFilters(
        Builder $query,
        Request $request
    ): void {
        /*
         * 1. PENCARIAN
         */
        if ($request->filled('search')) {
            $search =
                trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where(
                    'nomor_polisi',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'merek',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'nama_pemakai',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /*
         * 2. KATEGORI
         */
        if ($request->filled('kategori')) {
            $query->where(
                'kategori',
                $request->input('kategori')
            );
        }

        /*
         * 3. STATUS
         */
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        /*
         * 4. PAJAK / STNK
         */
        if ($request->filled('pajak_stnk')) {

            if (
                $request->input('pajak_stnk')
                === 'pajak_expired'
            ) {
                $query->whereDate(
                    'masa_berlaku_pajak',
                    '<',
                    now()
                );
            }

            if (
                $request->input('pajak_stnk')
                === 'stnk_expired'
            ) {
                $query->whereDate(
                    'masa_berlaku_stnk',
                    '<',
                    now()
                );
            }
        }

        /*
         * 5. SUMBER KENDARAAN
         *
         * Parameter URL:
         * ?sumber=APBD
         *
         * Kolom database:
         * sumber_kendaraan
         */
        if ($request->filled('sumber')) {
            $query->where(
                'sumber_kendaraan',
                $request->input('sumber')
            );
        }

        /*
         * 6. TAHUN PEMAKAIAN
         */
        if ($request->filled('tahun')) {
            $query->where(
                'tahun_pemakaian',
                $request->input('tahun')
            );
        }
    }
}