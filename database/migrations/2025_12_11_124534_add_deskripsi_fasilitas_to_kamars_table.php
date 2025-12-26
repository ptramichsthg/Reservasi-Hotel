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

            // Tambah kolom deskripsi (teks panjang, bisa kosong)
            $table->text('deskripsi')->nullable()->after('foto_utama');

            // Tambah kolom fasilitas (JSON, bisa kosong)
            $table->json('fasilitas')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            // Hapus kembali saat rollback
            $table->dropColumn(['deskripsi', 'fasilitas']);
        });
    }
};
