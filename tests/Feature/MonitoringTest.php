<?php

use App\Models\User;
use App\Models\Vehicle;
use Carbon\CarbonImmutable;

test('monitoring renders dates cast as CarbonImmutable', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Avanza',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 1234 IMM',
        'nomor_chasis' => 'CHASIS-IMMUTABLE-001',
        'nomor_mesin' => 'MESIN-IMMUTABLE-001',
        'tahun_pemakaian' => 2024,
        'masa_berlaku_pajak' => now()->addDays(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYear()->toDateString(),
        'nama_pemakai' => 'Pemakai Monitoring',
        'jabatan_pemakai' => 'Sopir',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    expect(diff_for_humans_id(CarbonImmutable::now()->addDay()))->toBe('1 hari lagi');
    expect(diff_for_humans_id(CarbonImmutable::now()->subDay()))->toBe('1 hari lalu');

    $this->actingAs($user)
        ->get(route('monitoring'))
        ->assertOk()
        ->assertSee($vehicle->nomor_polisi)
        ->assertSee('5 hari lagi');

    expect($vehicle->isPajakExpired())->toBeFalse()
        ->and($vehicle->isPajakExpiringSoon())->toBeTrue();
});
