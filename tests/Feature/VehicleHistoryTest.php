<?php

use App\Models\User;
use App\Models\Vehicle;

function vehicleHistoryPayload(array $overrides = []): array
{
    return array_merge([
        'merek' => 'Toyota',
        'tipe' => 'Avanza',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 1234 UJI',
        'nomor_chasis' => 'CHASIS-UJI-001',
        'nomor_mesin' => 'MESIN-UJI-001',
        'tahun_pemakaian' => 2024,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(2)->toDateString(),
        'nama_pemakai' => 'Pemakai Lama',
        'jabatan_pemakai' => 'Sopir',
        'keterangan_pajak' => null,
        'keterangan_kendaraan' => null,
        'anggaran_biaya' => 0,
        'biaya_plat_stnk' => 0,
        'sumber_dana' => 'APBD',
        'kategori' => 'Roda 4',
        'sub_kategori' => null,
        'status' => 'aktif',
    ], $overrides);
}

test('vehicle updates create a history with old and new values', function () {
    $user = User::factory()->create();
    $vehicle = Vehicle::create(vehicleHistoryPayload());

    $this->actingAs($user);

    $vehicle->update([
        'nama_pemakai' => 'Pemakai Baru',
        'jabatan_pemakai' => 'Manager',
        'status' => 'perbaikan',
    ]);

    $history = $vehicle->histories()->latest()->first();

    expect($history)->not->toBeNull()
        ->and($history->action)->toBe('updated')
        ->and($history->user_id)->toBe($user->id)
        ->and($history->changes['nama_pemakai']['old'])->toBe('Pemakai Lama')
        ->and($history->changes['nama_pemakai']['new'])->toBe('Pemakai Baru')
        ->and($history->changes['status']['old'])->toBe('aktif')
        ->and($history->changes['status']['new'])->toBe('perbaikan');
});
