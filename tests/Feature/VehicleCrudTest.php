<?php

use App\Models\User;
use App\Models\Vehicle;

test('authenticated user can view vehicle index with pagination and filters', function () {
    $user = User::factory()->create();

    Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Avanza',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 1234 CRUD',
        'nomor_chasis' => 'CHASIS-CRUD-1',
        'nomor_mesin' => 'MESIN-CRUD-1',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('vehicles.index', ['search' => '1234']));
    $response->assertOk();
    $response->assertSee('B 1234 CRUD');
});

test('user can view create vehicle page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('vehicles.create'));
    $response->assertOk();
    $response->assertSee('Tambah Kendaraan');
});

test('user can store a new vehicle', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('vehicles.store'), [
        'merek' => 'Honda',
        'tipe' => 'CR-V',
        'jenis' => 'SUV',
        'bahan_bakar' => 'Pertamax',
        'nomor_polisi' => 'B 9876 STORE',
        'nomor_chasis' => 'CHASIS-STORE-1',
        'nomor_mesin' => 'MESIN-STORE-1',
        'tahun_pemakaian' => 2022,
        'masa_berlaku_pajak' => now()->addMonths(12)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(5)->toDateString(),
        'nama_pemakai' => 'Doni',
        'jabatan_pemakai' => 'Kepala Bagian',
        'anggaran_biaya' => 7000000,
        'biaya_plat_stnk' => 2000000,
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response->assertRedirect(route('vehicles.index'));
    $response->assertSessionHas('success');

    $vehicle = Vehicle::where('nomor_polisi', 'B 9876 STORE')->first();
    expect($vehicle)->not->toBeNull();
    expect($vehicle->merek)->toBe('Honda');
    expect($vehicle->bahan_bakar)->toBe('Pertamax');
});

test('user can view vehicle show details and histories', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Yaris',
        'jenis' => 'Hatchback',
        'nomor_polisi' => 'B 3456 SHOW',
        'nomor_chasis' => 'CHASIS-SHOW-1',
        'nomor_mesin' => 'MESIN-SHOW-1',
        'tahun_pemakaian' => 2020,
        'masa_berlaku_pajak' => now()->addMonths(3)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(2)->toDateString(),
        'nama_pemakai' => 'Eka',
        'jabatan_pemakai' => 'Sekretaris',
        'sumber_kendaraan' => 'APBN',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('vehicles.show', $vehicle));
    $response->assertOk();
    $response->assertSee('B 3456 SHOW');
    $response->assertSee('Riwayat Perubahan');
});

test('user can view vehicle edit page', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Camry',
        'jenis' => 'Sedan',
        'nomor_polisi' => 'B 4567 EDIT',
        'nomor_chasis' => 'CHASIS-EDIT-1',
        'nomor_mesin' => 'MESIN-EDIT-1',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Fajar',
        'jabatan_pemakai' => 'Direktur',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('vehicles.edit', $vehicle));
    $response->assertOk();
    $response->assertSee('B 4567 EDIT');
});

test('user can update vehicle and preserves query parameters', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Rush',
        'jenis' => 'SUV',
        'nomor_polisi' => 'B 5678 UPD',
        'nomor_chasis' => 'CHASIS-UPD-1',
        'nomor_mesin' => 'MESIN-UPD-1',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Gani',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->put(route('vehicles.update', $vehicle), [
        'merek' => 'Toyota',
        'tipe' => 'Rush GR',
        'jenis' => 'SUV',
        'nomor_polisi' => 'B 5678 UPD',
        'nomor_chasis' => 'CHASIS-UPD-1',
        'nomor_mesin' => 'MESIN-UPD-1',
        'tahun_pemakaian' => 2021,
        'masa_berlaku_pajak' => now()->addMonths(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Gani Mulyo',
        'jabatan_pemakai' => 'Kepala Seksi',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
        'search' => 'Rush',
        'page' => 1,
    ]);

    $response->assertRedirect(route('vehicles.index', [
        'search' => 'Rush',
        'kategori' => 'roda_4',
        'status' => 'aktif',
        'page' => 1,
    ]));
    $response->assertSessionHas('success');

    $vehicle->refresh();
    expect($vehicle->tipe)->toBe('Rush GR');
    expect($vehicle->nama_pemakai)->toBe('Gani Mulyo');
});

test('user can delete vehicle and preserves query parameters', function () {
    $user = User::factory()->create();

    $vehicle = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Corolla',
        'jenis' => 'Sedan',
        'nomor_polisi' => 'B 6789 DEL',
        'nomor_chasis' => 'CHASIS-DEL-1',
        'nomor_mesin' => 'MESIN-DEL-1',
        'tahun_pemakaian' => 2020,
        'masa_berlaku_pajak' => now()->addMonths(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Hadi',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->delete(route('vehicles.destroy', $vehicle), [
        'kategori' => 'roda_4',
    ]);

    $response->assertRedirect(route('vehicles.index', ['kategori' => 'roda_4']));
    $response->assertSessionHas('success');

    expect(Vehicle::find($vehicle->id))->toBeNull();
});

test('vehicle export supports PDF and Excel format', function () {
    $user = User::factory()->create();

    Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Corolla',
        'jenis' => 'Sedan',
        'nomor_polisi' => 'B 7890 EXP',
        'nomor_chasis' => 'CHASIS-EXP-1',
        'nomor_mesin' => 'MESIN-EXP-1',
        'tahun_pemakaian' => 2020,
        'masa_berlaku_pajak' => now()->addMonths(5)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Iwan',
        'jabatan_pemakai' => 'Staf',
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    // Test PDF export
    $pdfResponse = $this->actingAs($user)->get(route('vehicles.export', ['format' => 'pdf']));
    $pdfResponse->assertOk();
    $pdfResponse->assertHeader('content-type', 'application/pdf');

    // Test XLSX export
    $xlsxResponse = $this->actingAs($user)->get(route('vehicles.export', ['format' => 'xlsx']));
    $xlsxResponse->assertOk();
    $xlsxResponse->assertHeader('content-disposition');
});
