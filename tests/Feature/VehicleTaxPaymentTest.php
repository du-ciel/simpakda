<?php

use App\Models\User;
use App\Models\Vehicle;

function taxVehicle(array $overrides = []): array
{
    return array_merge([
        'merek' => 'Toyota',
        'tipe' => 'Avanza',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 5678 TES',
        'nomor_chasis' => 'CHASIS-TAX-001',
        'nomor_mesin' => 'MESIN-TAX-001',
        'tahun_pemakaian' => 2024,
        'masa_berlaku_pajak' => now()->setMonth(10)->setDay(15)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(2)->toDateString(),
        'nama_pemakai' => 'Pemakai Pajak',
        'jabatan_pemakai' => 'Sopir',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ], $overrides);
}

test('monitoring can mark a current year vehicle tax as paid', function () {
    $user = User::factory()->create();
    $taxDueDate = now()->setMonth(8)->setDay(13)->toDateString();
    $stnkDueDate = now()->addYears(4)->setMonth(8)->setDay(13)->toDateString();
    $vehicle = Vehicle::create(taxVehicle([
        'masa_berlaku_pajak' => $taxDueDate,
        'masa_berlaku_stnk' => $stnkDueDate,
    ]));

    $this->actingAs($user)
        ->get(route('monitoring'))
        ->assertOk()
        ->assertSee($vehicle->nomor_polisi)
        ->assertSee('Perlu Dibayar');

    $this->post(route('vehicles.tax-paid', $vehicle))
        ->assertRedirect(route('monitoring'))
        ->assertSessionHas('success');

    $vehicle->refresh();

    expect($vehicle->masa_berlaku_pajak->toDateString())->toBe(now()->addYear()->setMonth(8)->setDay(13)->toDateString())
        ->and($vehicle->masa_berlaku_stnk->toDateString())->toBe($stnkDueDate)
        ->and($vehicle->pajak_dibayar_at)->not->toBeNull()
        ->and($vehicle->pajak_dibayar_at)->not->toBeNull();

    $this->actingAs($user)
        ->get(route('monitoring'))
        ->assertDontSee('Perlu Dibayar');

    $changes = $vehicle->histories()->where('action', 'updated')->latest()->first()->changes;

    expect($changes['pajak_dibayar_at']['new'])->not->toBeNull()
        ->and($changes['masa_berlaku_pajak']['new'])->toBe(now()->addYear()->setMonth(8)->setDay(13)->format('Y-m-d 00:00:00'))
        ->and($changes)->not->toHaveKey('masa_berlaku_stnk');

    $this->post(route('vehicles.tax-paid', $vehicle))
        ->assertRedirect(route('monitoring'));

    expect($vehicle->fresh()->masa_berlaku_pajak->toDateString())
        ->toBe(now()->addYear()->setMonth(8)->setDay(13)->toDateString());
});

test('changing the tax due date starts a new unpaid tax cycle', function () {
    $vehicle = Vehicle::create(taxVehicle([
        'nomor_polisi' => 'B 5679 TES',
        'nomor_chasis' => 'CHASIS-TAX-002',
        'nomor_mesin' => 'MESIN-TAX-002',
        'pajak_dibayar_at' => now(),
    ]));

    $vehicle->update([
        'masa_berlaku_pajak' => now()->addYear()->setMonth(10)->setDay(15)->toDateString(),
    ]);

    expect($vehicle->fresh()->pajak_dibayar_at)->toBeNull();
});
