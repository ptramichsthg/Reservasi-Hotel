<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom jam check-in dan check-out pada tabel reservasis
     */
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            // Jam check-in default 14:00 (standar hotel) - nullable untuk data existing
            $table->time('jam_checkin')->nullable()->default('14:00')->after('tgl_checkin');
            
            // Jam check-out default 12:00 (standar hotel) - nullable untuk data existing
            $table->time('jam_checkout')->nullable()->default('12:00')->after('tgl_checkout');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn(['jam_checkin', 'jam_checkout']);
        });
    }
};
