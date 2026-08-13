<?php

namespace App\Http\Controllers;

use App\Exports\VehiclesExport;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_polisi', 'like', '%'.$search.'%')
                    ->orWhere('merek', 'like', '%'.$search.'%')
                    ->orWhere('nama_pemakai', 'like', '%'.$search.'%');
            });
        }

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $vehicles = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoriList = Vehicle::select('kategori')->distinct()->pluck('kategori');

        return view('vehicles.index', compact('vehicles', 'kategoriList'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'nomor_polisi' => 'required|string|max:20|unique:vehicles,nomor_polisi',
            'nomor_chasis' => 'required|string|max:50|unique:vehicles,nomor_chasis',
            'nomor_mesin' => 'required|string|max:50|unique:vehicles,nomor_mesin',
            'tahun_pemakaian' => 'required|digits:4|integer|min:1990|max:'.date('Y'),
            'masa_berlaku_pajak' => 'required|date',
            'masa_berlaku_stnk' => 'required|date',
            'nama_pemakai' => 'required|string|max:100',
            'jabatan_pemakai' => 'required|string|max:100',
            'keterangan_pajak' => 'nullable|string',
            'keterangan_kendaraan' => 'nullable|string',
            'anggaran_biaya' => 'nullable|numeric|min:0',
            'biaya_plat_stnk' => 'nullable|numeric|min:0',
            'sumber_dana' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'sub_kategori' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,non_aktif,perbaikan,dijual',
        ]);

        $validated['anggaran_biaya'] = $validated['anggaran_biaya'] ?? 0;
        $validated['biaya_plat_stnk'] = $validated['biaya_plat_stnk'] ?? 0;

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('histories.user');

        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'nomor_polisi' => 'required|string|max:20|unique:vehicles,nomor_polisi,'.$vehicle->id,
            'nomor_chasis' => 'required|string|max:50|unique:vehicles,nomor_chasis,'.$vehicle->id,
            'nomor_mesin' => 'required|string|max:50|unique:vehicles,nomor_mesin,'.$vehicle->id,
            'tahun_pemakaian' => 'required|digits:4|integer|min:1990|max:'.date('Y'),
            'masa_berlaku_pajak' => 'required|date',
            'masa_berlaku_stnk' => 'required|date',
            'nama_pemakai' => 'required|string|max:100',
            'jabatan_pemakai' => 'required|string|max:100',
            'keterangan_pajak' => 'nullable|string',
            'keterangan_kendaraan' => 'nullable|string',
            'anggaran_biaya' => 'nullable|numeric|min:0',
            'biaya_plat_stnk' => 'nullable|numeric|min:0',
            'sumber_dana' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'sub_kategori' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,non_aktif,perbaikan,dijual',
        ]);

        $validated['anggaran_biaya'] = $validated['anggaran_biaya'] ?? 0;
        $validated['biaya_plat_stnk'] = $validated['biaya_plat_stnk'] ?? 0;

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil diupdate.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_polisi', 'like', '%'.$search.'%')
                    ->orWhere('merek', 'like', '%'.$search.'%')
                    ->orWhere('nama_pemakai', 'like', '%'.$search.'%');
            });
        }

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $vehicles = $query->orderBy('created_at', 'desc')->get();
        $format = $request->get('format', 'xlsx');

        if ($format === 'csv') {
            return (new VehiclesExport($vehicles->all()))->downloadCsv();
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('vehicles.export-pdf', [
                'vehicles' => $vehicles,
                'printedAt' => now()->format('d/m/Y H:i'),
            ]);

            $pdf->setPaper('A4', 'landscape');

            return $pdf->download('data-kendaraan-'.date('Y-m-d-His').'.pdf');
        }

        return (new VehiclesExport($vehicles->all()))->downloadXlsx();
    }
}
