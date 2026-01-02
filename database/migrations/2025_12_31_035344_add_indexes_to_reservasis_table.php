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
        Schema::table('reservasis', function (Blueprint $table) {
            // Index untuk kolom yang sering di-query
            $table->index('id_kamar', 'idx_reservasis_id_kamar');
            $table->index('id_user', 'idx_reservasis_id_user');
            $table->index('status_reservasi', 'idx_reservasis_status_reservasi');
            
            // Composite index untuk date range queries
            $table->index(['tgl_checkin', 'tgl_checkout'], 'idx_reservasis_dates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropIndex('idx_reservasis_id_kamar');
            $table->dropIndex('idx_reservasis_id_user');
            $table->dropIndex('idx_reservasis_status_reservasi');
            $table->dropIndex('idx_reservasis_dates');
        });
    }
};
