<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            // Tambah kolom kapasitas tamu
            $table->unsignedInteger('kapasitas')
                  ->default(2)
                  ->after('fasilitas')
                  ->comment('Jumlah maksimal tamu per kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
    }
};
