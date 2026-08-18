<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            // Spesifikasi Kendaraan
            $table->string('merek', 50);
            $table->string('tipe', 50);
            $table->string('jenis', 50);
            $table->string('nomor_polisi', 20)->unique();
            $table->string('nomor_chasis', 50)->unique();
            $table->string('nomor_mesin', 50)->unique();
            $table->year('tahun_pemakaian');

            // Masa Berlaku
            $table->date('masa_berlaku_pajak');
            $table->date('masa_berlaku_stnk');

            // Pemakai
            $table->string('nama_pemakai', 100);
            $table->string('jabatan_pemakai', 100);

            // Keterangan
            $table->text('keterangan_pajak')->nullable();
            $table->text('keterangan_kendaraan')->nullable();

            // Biaya
            $table->decimal('anggaran_biaya', 15, 0)->default(0);
            $table->decimal('biaya_plat_stnk', 15, 0)->default(0);
            $table->string('sumber_kendaraan', 100);

            // Kategori
            $table->string('kategori', 50);
            $table->string('sub_kategori', 50)->nullable();

            // Status
            $table->enum('status', ['aktif', 'non_aktif', 'perbaikan', 'dijual'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
