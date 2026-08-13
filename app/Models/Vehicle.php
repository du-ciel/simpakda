<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'merek',
        'tipe',
        'jenis',
        'nomor_polisi',
        'nomor_chasis',
        'nomor_mesin',
        'tahun_pemakaian',
        'masa_berlaku_pajak',
        'masa_berlaku_stnk',
        'nama_pemakai',
        'jabatan_pemakai',
        'keterangan_pajak',
        'keterangan_kendaraan',
        'anggaran_biaya',
        'biaya_plat_stnk',
        'sumber_dana',
        'kategori',
        'sub_kategori',
        'status',
    ];

    protected $casts = [
        'masa_berlaku_pajak' => 'date',
        'masa_berlaku_stnk' => 'date',
        'tahun_pemakaian' => 'integer',
        'anggaran_biaya' => 'decimal:0',
        'biaya_plat_stnk' => 'decimal:0',
    ];

    protected static function booted(): void
    {
        static::created(function (Vehicle $vehicle): void {
            $vehicle->recordHistory('created', $vehicle->getAttributes());
        });

        static::updated(function (Vehicle $vehicle): void {
            $changes = $vehicle->getChanges();
            unset($changes['updated_at']);

            if ($changes !== []) {
                $vehicle->recordHistory('updated', $changes);
            }
        });
    }

    public function histories()
    {
        return $this->hasMany(VehicleHistory::class)->latest();
    }

    public function recordHistory(string $action, array $values): void
    {
        $changes = [];

        foreach ($values as $field => $newValue) {
            if (in_array($field, ['id', 'created_at', 'updated_at'], true)) {
                continue;
            }

            $oldValue = $action === 'created' ? null : $this->getOriginal($field);
            $changes[$field] = [
                'old' => $this->historyValue($oldValue),
                'new' => $this->historyValue($newValue),
            ];
        }

        if ($changes === []) {
            return;
        }

        VehicleHistory::create([
            'vehicle_id' => $this->getKey(),
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }

    private function historyValue(mixed $value): mixed
    {
        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        if (is_scalar($value) || $value === null) {
            return $value;
        }

        return (string) $value;
    }

    public function isPajakExpired(): bool
    {
        return $this->masa_berlaku_pajak->isPast();
    }

    public function isStnkExpired(): bool
    {
        return $this->masa_berlaku_stnk->isPast();
    }

    public function isPajakExpiringSoon(int $days = 30): bool
    {
        return $this->masa_berlaku_pajak->between(now(), now()->addDays($days));
    }
}
