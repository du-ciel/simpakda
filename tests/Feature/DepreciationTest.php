<?php

use App\Models\Depreciation;
use App\Models\User;
use App\Models\Vehicle;

test('guests are redirected from depreciation page', function () {
    $response = $this->get(route('penyusutan.index'));
    $response->assertRedirect(route('login'));
});

test('depreciation index displays vehicles and calculated values', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 7777 DEP',
        'nomor_chasis' => 'CHASIS-DEP-1',
        'nomor_mesin' => 'MESIN-DEP-1',
        'tahun_pemakaian' => 2020,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    // Kelompok 1: masa manfaat 10 tahun, tarif 6.25%
    Depreciation::create([
        'vehicle_id' => $vehicle->id,
        'nilai_perolehan' => 100000000,
        'tahun_perolehan' => 2020,
        'kelompok_penyusutan' => 1,
        'masa_manfaat' => 10,
        'tarif_penyusutan' => 6.25,
        'metode_penyusutan' => 'garis_lurus',
    ]);

    $response = $this->actingAs($user)->get(route('penyusutan.index'));
    $response->assertOk();
    $response->assertSee('B 7777 DEP');
    $response->assertSee('100.000.000');
});

test('user can view depreciation edit page', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 8888 DEP',
        'nomor_chasis' => 'CHASIS-DEP-2',
        'nomor_mesin' => 'MESIN-DEP-2',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('penyusutan.edit', $vehicle));
    $response->assertOk();
    $response->assertSee('Edit Penyusutan Kendaraan');
    $response->assertSee('B 8888 DEP');
});

test('user can update depreciation data for a vehicle', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 9999 DEP',
        'nomor_chasis' => 'CHASIS-DEP-3',
        'nomor_mesin' => 'MESIN-DEP-3',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->put(route('penyusutan.update', $vehicle), [
        'nilai_perolehan' => '200.000.000', // testing currency formatted input
        'tahun_perolehan' => 2021,
        'kelompok_penyusutan' => 1,
        'masa_manfaat' => 10,
        'tarif_penyusutan' => '6.25',
        'metode_penyusutan' => 'garis_lurus',
    ]);

    $response->assertRedirect(route('penyusutan.index'));
    $response->assertSessionHas('success');

    $depreciation = Depreciation::where('vehicle_id', $vehicle->id)->first();
    expect($depreciation)->not->toBeNull();
    expect((float) $depreciation->nilai_perolehan)->toBe(200000000.0);
    expect($depreciation->kelompok_penyusutan)->toBe(1);
    expect($depreciation->masa_manfaat)->toBe(10);
});

test('depreciation can be exported to Excel', function () {
    $user = User::factory()->create();

    Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 1010 DEP',
        'nomor_chasis' => 'CHASIS-DEP-4',
        'nomor_mesin' => 'MESIN-DEP-4',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('penyusutan.exportExcel'));
    $response->assertOk();
    $response->assertHeader('content-disposition');
});
