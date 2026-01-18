<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();

            // ID User yang menerima notifikasi
            $table->unsignedBigInteger('id_user');

            // Judul & isi notifikasi
            $table->string('judul');
            $table->text('pesan');

            // Status notifikasi (0 = belum dibaca)
            $table->boolean('is_read')->default(0);

            $table->timestamps();

            // Relasi ke tabel users (opsional jika kamu pakai foreign key)
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
