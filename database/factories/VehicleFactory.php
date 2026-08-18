<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'merek' => fake()->randomElement(['Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Hyundai', 'Wuling']),
            'tipe' => fake()->randomElement(['Avanza', 'Brio', 'Ertiga', 'Xpander', 'Stargazer']),
            'jenis' => fake()->randomElement(['Minibus', 'Sedan', 'Pick Up']),
            'nomor_polisi' => strtoupper(fake()->unique()->bothify('?? #### ???')),
            'nomor_chasis' => strtoupper(fake()->unique()->bothify('MH1##########??????')),
            'nomor_mesin' => strtoupper(fake()->unique()->bothify('NC##E########')),
            'tahun_pemakaian' => fake()->numberBetween(1990, (int) date('Y')),
            'masa_berlaku_pajak' => fake()->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'masa_berlaku_stnk' => fake()->dateTimeBetween('today', '+5 years')->format('Y-m-d'),
            'nama_pemakai' => fake()->name(),
            'jabatan_pemakai' => fake()->jobTitle(),
            'anggaran_biaya' => fake()->numberBetween(0, 500000000),
            'biaya_plat_stnk' => fake()->numberBetween(0, 1000000),
            'sumber_kendaraan' => fake()->randomElement(['APBD', 'APBN', 'Hibah']),
            'kategori' => fake()->randomElement(['roda_2', 'roda_4']),
            'sub_kategori' => fake()->optional()->word(),
            'status' => fake()->randomElement(['aktif', 'aktif', 'aktif', 'non_aktif', 'perbaikan', 'dijual']),
        ];
    }

    public function motor(): static
    {
        return $this->state(fn (array $attributes) => [
            'kategori' => 'roda_2',
            'jenis' => 'Sepeda Motor',
        ]);
    }

    public function mobil(): static
    {
        return $this->state(fn (array $attributes) => [
            'kategori' => 'roda_4',
            'jenis' => 'Minibus',
        ]);
    }

    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'aktif']);
    }
}
