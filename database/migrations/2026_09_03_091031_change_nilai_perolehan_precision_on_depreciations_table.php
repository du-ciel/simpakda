<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('depreciations', function (Blueprint $table) {
            $table->decimal('nilai_perolehan', 20, 2)
                ->default(0)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('depreciations', function (Blueprint $table) {
            $table->decimal('nilai_perolehan', 15, 0)
                ->default(0)
                ->change();
        });
    }
};