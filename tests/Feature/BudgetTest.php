<?php

use App\Models\User;
use App\Models\Vehicle;

test('guests are redirected from budget page', function () {
    $response = $this->get(route('anggaran'));
    $response->assertRedirect(route('login'));
});

test('authenticated user can view budget page and see totals', function () {
    $user = User::factory()->create();

    Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 1111 BUD',
        'nomor_chasis' => 'CHASIS-BUD-1',
        'nomor_mesin' => 'MESIN-BUD-1',
        'tahun_pemakaian' => 2022,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'anggaran_biaya' => 5000000,
        'biaya_plat_stnk' => 1500000,
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    Vehicle::create([
        'merek' => 'Honda',
        'tipe' => 'Vario',
        'jenis' => 'Sepeda Motor',
        'nomor_polisi' => 'B 2222 BUD',
        'nomor_chasis' => 'CHASIS-BUD-2',
        'nomor_mesin' => 'MESIN-BUD-2',
        'tahun_pemakaian' => 2023,
        'masa_berlaku_pajak' => now()->addMonths(4)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(2)->toDateString(),
        'nama_pemakai' => 'Andi',
        'jabatan_pemakai' => 'Kurir',
        'anggaran_biaya' => 1000000,
        'biaya_plat_stnk' => 500000,
        'sumber_kendaraan' => 'APBN',
        'kategori' => 'roda_2',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('anggaran'));
    $response->assertOk();
    $response->assertSee('B 1111 BUD');
    $response->assertSee('B 2222 BUD');
    // Total anggaran = 5jt + 1jt = 6.000.000
    $response->assertSee('6.000.000');
    // Total plat/stnk = 1.5jt + 500rb = 2.000.000
    $response->assertSee('2.000.000');
    // Total keseluruhan = 8.000.000
    $response->assertSee('8.000.000');
});

test('budget page can be filtered by source and category', function () {
    $user = User::factory()->create();

    $v1 = Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 3333 APBD',
        'nomor_chasis' => 'CHASIS-BUD-3',
        'nomor_mesin' => 'MESIN-BUD-3',
        'tahun_pemakaian' => 2022,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'anggaran_biaya' => 5000000,
        'biaya_plat_stnk' => 1500000,
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $v2 = Vehicle::create([
        'merek' => 'Honda',
        'tipe' => 'Vario',
        'jenis' => 'Sepeda Motor',
        'nomor_polisi' => 'B 4444 APBN',
        'nomor_chasis' => 'CHASIS-BUD-4',
        'nomor_mesin' => 'MESIN-BUD-4',
        'tahun_pemakaian' => 2023,
        'masa_berlaku_pajak' => now()->addMonths(4)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(2)->toDateString(),
        'nama_pemakai' => 'Andi',
        'jabatan_pemakai' => 'Kurir',
        'anggaran_biaya' => 1000000,
        'biaya_plat_stnk' => 500000,
        'sumber_kendaraan' => 'APBN',
        'kategori' => 'roda_2',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('anggaran', ['sumber' => 'APBD']));
    $response->assertOk();
    $response->assertSee('B 3333 APBD');
    $response->assertDontSee('B 4444 APBN');
});

test('budget report can be exported as PDF', function () {
    $user = User::factory()->create();

    Vehicle::create([
        'merek' => 'Toyota',
        'tipe' => 'Innova',
        'jenis' => 'Minibus',
        'nomor_polisi' => 'B 5555 PDF',
        'nomor_chasis' => 'CHASIS-BUD-5',
        'nomor_mesin' => 'MESIN-BUD-5',
        'tahun_pemakaian' => 2022,
        'masa_berlaku_pajak' => now()->addMonths(6)->toDateString(),
        'masa_berlaku_stnk' => now()->addYears(3)->toDateString(),
        'nama_pemakai' => 'Budi',
        'jabatan_pemakai' => 'Staf',
        'anggaran_biaya' => 5000000,
        'biaya_plat_stnk' => 1500000,
        'sumber_kendaraan' => 'APBD',
        'kategori' => 'roda_4',
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($user)->get(route('anggaran.export-pdf'));
    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
});
