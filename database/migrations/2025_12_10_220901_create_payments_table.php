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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel reservasi
            $table->unsignedBigInteger('reservasi_id');

            // File bukti pembayaran
            $table->string('bukti_pembayaran')->nullable();

            // Status verifikasi oleh admin
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

            // Admin yang memverifikasi
            $table->unsignedBigInteger('admin_id')->nullable();

            // Waktu upload & verifikasi
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('reservasi_id')
                ->references('id_reservasi')
                ->on('reservasis')
                ->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
