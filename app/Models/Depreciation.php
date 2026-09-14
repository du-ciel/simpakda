<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depreciation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'nilai_perolehan',
        'tahun_perolehan',
        'kelompok_penyusutan',
        'masa_manfaat',
        'tarif_penyusutan',
        'metode_penyusutan',
    ];

    protected $casts = [
        'vehicle_id' => 'integer',
        'nilai_perolehan' => 'decimal:0',
        'tahun_perolehan' => 'integer',
        'kelompok_penyusutan' => 'integer',
        'masa_manfaat' => 'integer',
        'tarif_penyusutan' => 'decimal:2',
    ];

    /**
     * Data kendaraan yang terkait dengan penyusutan.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Penyusutan tahunan berdasarkan metode garis lurus.
     */
    public function getPenyusutanTahunanAttribute(): float
    {
        return (float) $this->nilai_perolehan
            * ((float) $this->tarif_penyusutan / 100);
    }

    /**
     * Umur aset berdasarkan tahun perolehan.
     */
    public function getUmurAsetAttribute(): int
    {
        return max(
            0,
            now()->year - (int) $this->tahun_perolehan
        );
    }

    /**
     * Jumlah tahun yang sudah disusutkan.
     *
     * Tidak boleh melebihi masa manfaat.
     */
    public function getTahunDisusutkanAttribute(): int
    {
        return min(
            $this->umur_aset,
            (int) $this->masa_manfaat
        );
    }

    /**
     * Akumulasi penyusutan.
     *
     * Nilai akumulasi tidak boleh melebihi nilai perolehan.
     */
    public function getAkumulasiPenyusutanAttribute(): float
    {
        $akumulasi = $this->penyusutan_tahunan
            * $this->tahun_disusutkan;

        return min(
            (float) $this->nilai_perolehan,
            $akumulasi
        );
    }

    /**
     * Nilai buku kendaraan.
     */
    public function getNilaiBukuAttribute(): float
    {
        return max(
            0,
            (float) $this->nilai_perolehan
                - $this->akumulasi_penyusutan
        );
    }

    /**
     * Status penyusutan kendaraan.
     */
    public function getStatusPenyusutanAttribute(): string
    {
        if ((float) $this->nilai_perolehan <= 0) {
            return 'Belum Ada Nilai';
        }

        if ($this->tahun_disusutkan >= (int) $this->masa_manfaat) {
            return 'Masa Manfaat Berakhir';
        }

        if ($this->umur_aset <= 0) {
            return 'Belum Disusutkan';
        }

        return 'Dalam Penyusutan';
    }

    /**
     * Nama kelompok penyusutan.
     */
    public function getNamaKelompokPenyusutanAttribute(): string
    {
        return match ((int) $this->kelompok_penyusutan) {
            1 => 'Kelompok 1',
            2 => 'Kelompok 2',
            3 => 'Kelompok 3',
            4 => 'Kelompok 4',
            default => 'Tidak Ditentukan',
        };
    }
}