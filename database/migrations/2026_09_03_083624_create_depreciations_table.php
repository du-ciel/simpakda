<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('depreciations', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi Kendaraan
            |--------------------------------------------------------------------------
            |
            | Satu kendaraan memiliki satu data penyusutan.
            |
            */
            $table->foreignId('vehicle_id')
                ->unique()
                ->constrained('vehicles')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data Dasar Penyusutan
            |--------------------------------------------------------------------------
            */

            // Nilai perolehan khusus untuk perhitungan penyusutan.
            // Mendukung 2 angka desimal.
            // Contoh: 250000000.50
            $table->decimal('nilai_perolehan', 20, 2)
                ->default(0);

            // Tahun kendaraan diperoleh untuk keperluan penyusutan.
            $table->year('tahun_perolehan');

            /*
            |--------------------------------------------------------------------------
            | Ketentuan Penyusutan
            |--------------------------------------------------------------------------
            */

            // Kelompok penyusutan: 1, 2, 3, atau 4.
            $table->unsignedTinyInteger('kelompok_penyusutan');

            // Masa manfaat dalam tahun.
            $table->unsignedSmallInteger('masa_manfaat');

            // Tarif penyusutan dalam persen.
            // Contoh: 25.00, 12.50, 6.25, 5.00
            $table->decimal('tarif_penyusutan', 5, 2);

            // Saat ini menggunakan metode garis lurus.
            $table->string('metode_penyusutan', 30)
                ->default('garis_lurus');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index('tahun_perolehan');
            $table->index('kelompok_penyusutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('depreciations');
    }
};