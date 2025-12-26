<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamars', function (Blueprint $table) {

            // UPDATE ENUM STATUS
            $table->enum('status', [
                'available',
                'booked',
                'maintenance',
                'unavailable'
            ])->default('available')->change();

            // TAMBAH KAPASITAS
            $table->integer('kapasitas')->default(1)->after('harga');

        });
    }

    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {

            // Kembalikan ke kondisi lama jika rollback
            $table->enum('status', ['available', 'booked'])
                  ->default('available')
                  ->change();

            $table->dropColumn('kapasitas');

        });
    }
};
