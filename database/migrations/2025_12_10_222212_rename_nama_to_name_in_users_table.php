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
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom "nama" menjadi "name"
            if (Schema::hasColumn('users', 'nama')) {
                $table->renameColumn('nama', 'name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Balikkan jika ingin rollback
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'nama');
            }
        });
    }
};
