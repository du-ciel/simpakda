<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['motor', 'mobil']);

        return [
            'type' => $type,
            'plat_nomor' => strtoupper(fake()->bothify('?? ### ??')),
            'merk' => $type === 'motor' ? fake()->randomElement(['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'TVS']) : fake()->randomElement(['Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Hyundai', 'Wuling']),
            'model' => $type === 'motor' ? fake()->randomElement(['Vario', 'Beat', 'Nmax', 'Vixion', 'CBR']) : fake()->randomElement(['Avanza', 'Brio', 'Xpander', 'Ertiga', 'Calya']),
            'warna' => fake()->randomElement(['Hitam', 'Putih', 'Merah', 'Biru', 'Abu-abu', 'Silver']),
            'tahun' => fake()->numberBetween(2015, 2024),
            'nomor_rangka' => strtoupper(fake()->bothify('MH1##########??????')),
            'nomor_mesin' => strtoupper(fake()->bothify('NC##E########')),
            'tanggal_pajak' => fake()->dateTimeBetween('-2 years', 'now'),
            'jatuh_tempo_pajak' => fake()->dateTimeBetween('now', '+1 year'),
            'masa_berlaku_stnk' => fake()->dateTimeBetween('now', '+5 years'),
            'nama_pemilik' => fake()->name(),
            'alamat' => fake()->address(),
            'status' => fake()->randomElement(['aktif', 'aktif', 'aktif', 'non_aktif']),
        ];
    }

    public function motor(): static
    {
        return $this->state(fn (array $attributes) => ['type' => 'motor']);
    }

    public function mobil(): static
    {
        return $this->state(fn (array $attributes) => ['type' => 'mobil']);
    }

    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'aktif']);
    }
}
