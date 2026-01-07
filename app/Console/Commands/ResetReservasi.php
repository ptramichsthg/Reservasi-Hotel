<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetReservasi extends Command
{
    /**
     * Nama dan signature dari console command.
     *
     * @var string
     */
    protected $signature = 'reservasi:reset 
                            {--force : Paksa reset tanpa konfirmasi}';

    /**
     * Deskripsi console command.
     *
     * @var string
     */
    protected $description = 'Reset ID reservasi dan pembayaran dari 0 (menghapus semua data reservasi & pembayaran)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Konfirmasi jika tidak pakai --force
        if (!$this->option('force')) {
            if (!$this->confirm('⚠️  PERINGATAN: Ini akan menghapus SEMUA data reservasi dan pembayaran. Lanjutkan?')) {
                $this->info('❌ Reset dibatalkan.');
                return 0;
            }
        }

        $this->info('🔄 Memulai reset...');

        try {
            // 1. Hapus semua pembayaran (karena ada foreign key)
            $paymentCount = DB::table('payments')->count();
            DB::table('payments')->delete();
            $this->info("✅ Berhasil menghapus {$paymentCount} data pembayaran");

            // 2. Hapus semua reservasi
            $reservasiCount = DB::table('reservasis')->count();
            DB::table('reservasis')->delete();
            $this->info("✅ Berhasil menghapus {$reservasiCount} data reservasi");

            // 3. Reset auto increment ID (SQLite)
            DB::statement("DELETE FROM sqlite_sequence WHERE name='payments'");
            DB::statement("DELETE FROM sqlite_sequence WHERE name='reservasis'");
            $this->info("✅ Auto increment ID berhasil direset ke 1");

            $this->newLine();
            $this->info('🎉 Reset selesai! ID reservasi berikutnya akan dimulai dari 1.');

            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return 1;
        }
    }
}
