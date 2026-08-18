<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table): void {
            $table->index('status');
            $table->index('masa_berlaku_pajak');
            $table->index('masa_berlaku_stnk');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table): void {
            $table->dropIndex(['status']);
            $table->dropIndex(['masa_berlaku_pajak']);
            $table->dropIndex(['masa_berlaku_stnk']);
        });
    }
};
