<?php

namespace App\Console\Commands;

use App\Models\Notifikasi;
use App\Models\Payment;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDataForGithub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-data-for-github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset semua data kecuali admin untuk persiapan push ke GitHub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('⚠️  PERINGATAN: Command ini akan menghapus data berikut:');
        $this->line('  - Semua data pembayaran (payments)');
        $this->line('  - Semua data reservasi (reservasis)');
        $this->line('  - Semua data notifikasi (notifikasis)');
        $this->line('  - Semua user KECUALI admin');
        $this->newLine();

        // Tampilkan admin yang akan dipertahankan
        $admins = User::where('role', 'admin')->get();
        if ($admins->isEmpty()) {
            $this->error('❌ Tidak ada admin yang ditemukan! Pastikan ada user dengan role "admin".');

            return 1;
        }

        $this->info('✅ Admin yang akan dipertahankan:');
        foreach ($admins as $admin) {
            $this->line("  - {$admin->name} ({$admin->email})");
        }
        $this->newLine();

        if (! $this->confirm('Apakah Anda yakin ingin melanjutkan?', false)) {
            $this->info('❌ Operasi dibatalkan.');

            return 0;
        }

        $this->newLine();
        $this->info('🔄 Memulai proses reset data...');

        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // 1. Hapus semua payments
            $paymentsCount = Payment::count();
            DB::table('payments')->truncate();
            $this->line("  ✓ Menghapus {$paymentsCount} data pembayaran");

            // 2. Hapus semua notifikasi
            $notifikasiCount = Notifikasi::count();
            DB::table('notifikasis')->truncate();
            $this->line("  ✓ Menghapus {$notifikasiCount} data notifikasi");

            // 3. Hapus semua reservasi
            $reservasiCount = Reservasi::count();
            DB::table('reservasis')->truncate();
            $this->line("  ✓ Menghapus {$reservasiCount} data reservasi");

            // 4. Hapus user yang bukan admin
            $nonAdminCount = User::where('role', '!=', 'admin')->count();
            User::where('role', '!=', 'admin')->delete();
            $this->line("  ✓ Menghapus {$nonAdminCount} user non-admin");

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->newLine();
            $this->info('🎉 Reset data berhasil!');
            $this->info('📦 Project siap untuk di-push ke GitHub.');

            return 0;

        } catch (\Exception $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->error('❌ Error: '.$e->getMessage());

            return 1;
        }
    }
}
