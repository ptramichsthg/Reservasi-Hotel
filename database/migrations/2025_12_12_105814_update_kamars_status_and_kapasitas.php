<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // UPDATE ENUM STATUS menggunakan raw SQL
        DB::statement("ALTER TABLE kamars MODIFY COLUMN status ENUM('available', 'booked', 'maintenance', 'unavailable') DEFAULT 'available'");

        // TAMBAH KAPASITAS jika belum ada
        if (!Schema::hasColumn('kamars', 'kapasitas')) {
            Schema::table('kamars', function (Blueprint $table) {
                $table->integer('kapasitas')->default(1)->after('harga');
            });
        }
    }

    public function down(): void
    {
        // Kembalikan ke kondisi lama jika rollback
        DB::statement("ALTER TABLE kamars MODIFY COLUMN status ENUM('available', 'booked') DEFAULT 'available'");

        // Hapus kolom kapasitas
        if (Schema::hasColumn('kamars', 'kapasitas')) {
            Schema::table('kamars', function (Blueprint $table) {
                $table->dropColumn('kapasitas');
            });
        }
    }
};
