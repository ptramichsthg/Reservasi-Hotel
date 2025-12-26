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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->bigIncrements('id_reservasi');

            // Relasi user & kamar
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kamar');

            // Tanggal check-in dan check-out
            $table->date('tgl_checkin');
            $table->date('tgl_checkout');

            // Status pembayaran & reservasi
            $table->enum('status_pembayaran', ['pending', 'verified', 'rejected'])->default('pending');
            $table->enum('status_reservasi', ['pending', 'confirmed', 'cancelled'])->default('pending');

            // Jumlah tamu
            $table->integer('jumlah_tamu')->default(1);

            // Total harga
            $table->bigInteger('total_harga')->default(0);

            $table->timestamps();

            // Foreign keys
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_kamar')
                  ->references('id_kamar')
                  ->on('kamars')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
