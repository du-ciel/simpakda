<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use Livewire\Component;

class Create extends Component
{
    public ?Vehicle $vehicle = null;

    public string $merek = '';

    public string $tipe = '';

    public string $jenis = '';

    public string $nomor_polisi = '';

    public string $nomor_chasis = '';

    public string $nomor_mesin = '';

    public string $tahun_pemakaian = '';

    public string $masa_berlaku_pajak = '';

    public string $masa_berlaku_stnk = '';

    public string $nama_pemakai = '';

    public string $jabatan_pemakai = '';

    public string $keterangan_pajak = '';

    public string $keterangan_kendaraan = '';

    public string $anggaran_biaya = '';

    public string $biaya_plat_stnk = '';

    public string $sumber_dana = '';

    public string $kategori = '';

    public string $sub_kategori = '';

    public string $status = 'aktif';

    protected function rules(): array
    {
        return [
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'jenis' => 'required|string|max:50',
            'nomor_polisi' => $this->vehicle ? 'required|string|max:20|unique:vehicles,nomor_polisi,'.$this->vehicle->id : 'required|string|max:20|unique:vehicles,nomor_polisi',
            'nomor_chasis' => $this->vehicle ? 'required|string|max:50|unique:vehicles,nomor_chasis,'.$this->vehicle->id : 'required|string|max:50|unique:vehicles,nomor_chasis',
            'nomor_mesin' => $this->vehicle ? 'required|string|max:50|unique:vehicles,nomor_mesin,'.$this->vehicle->id : 'required|string|max:50|unique:vehicles,nomor_mesin',
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
        ];
    }

    public function mount(?Vehicle $vehicle = null): void
    {
        if ($vehicle && $vehicle->exists) {
            $this->vehicle = $vehicle;
            $this->fillForm();
        }
    }

    public function fillForm(): void
    {
        $this->merek = $this->vehicle->merek;
        $this->tipe = $this->vehicle->tipe;
        $this->jenis = $this->vehicle->jenis;
        $this->nomor_polisi = $this->vehicle->nomor_polisi;
        $this->nomor_chasis = $this->vehicle->nomor_chasis;
        $this->nomor_mesin = $this->vehicle->nomor_mesin;
        $this->tahun_pemakaian = (string) $this->vehicle->tahun_pemakaian;
        $this->masa_berlaku_pajak = $this->vehicle->masa_berlaku_pajak->format('Y-m-d');
        $this->masa_berlaku_stnk = $this->vehicle->masa_berlaku_stnk->format('Y-m-d');
        $this->nama_pemakai = $this->vehicle->nama_pemakai;
        $this->jabatan_pemakai = $this->vehicle->jabatan_pemakai;
        $this->keterangan_pajak = $this->vehicle->keterangan_pajak ?? '';
        $this->keterangan_kendaraan = $this->vehicle->keterangan_kendaraan ?? '';
        $this->anggaran_biaya = (string) $this->vehicle->anggaran_biaya;
        $this->biaya_plat_stnk = (string) $this->vehicle->biaya_plat_stnk;
        $this->sumber_dana = $this->vehicle->sumber_dana;
        $this->kategori = $this->vehicle->kategori;
        $this->sub_kategori = $this->vehicle->sub_kategori ?? '';
        $this->status = $this->vehicle->status;
    }

    public function save(): void
    {
        $this->validate($this->rules());

        Vehicle::updateOrCreate(
            ['id' => $this->vehicle?->id],
            [
                'merek' => $this->merek,
                'tipe' => $this->tipe,
                'jenis' => $this->jenis,
                'nomor_polisi' => $this->nomor_polisi,
                'nomor_chasis' => $this->nomor_chasis,
                'nomor_mesin' => $this->nomor_mesin,
                'tahun_pemakaian' => (int) $this->tahun_pemakaian,
                'masa_berlaku_pajak' => $this->masa_berlaku_pajak,
                'masa_berlaku_stnk' => $this->masa_berlaku_stnk,
                'nama_pemakai' => $this->nama_pemakai,
                'jabatan_pemakai' => $this->jabatan_pemakai,
                'keterangan_pajak' => $this->keterangan_pajak ?: null,
                'keterangan_kendaraan' => $this->keterangan_kendaraan ?: null,
                'anggaran_biaya' => $this->anggaran_biaya ? (float) $this->anggaran_biaya : 0,
                'biaya_plat_stnk' => $this->biaya_plat_stnk ? (float) $this->biaya_plat_stnk : 0,
                'sumber_dana' => $this->sumber_dana,
                'kategori' => $this->kategori,
                'sub_kategori' => $this->sub_kategori ?: null,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->vehicle ? 'Kendaraan berhasil diupdate.' : 'Kendaraan berhasil ditambahkan.');
        $this->redirect(route('vehicles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.vehicle.create');
    }
}
