<?php

use Illuminate\Support\Facades\Route;

// ===============================
//  IMPORT CONTROLLER
// ===============================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\TamuProfileController;


// ===============================
//  LANDING PAGE
// ===============================
Route::get('/', function () {
    return view('welcome');
});


// ===============================
//  AUTH ROUTES
// ===============================
Route::get('/login', [AuthController::class, 'loginView'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ===============================
//  FORGOT & RESET PASSWORD
// ===============================
Route::middleware('guest')->group(function () {

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])
        ->name('password.update');
});


// ======================================================
//  ADMIN ROUTES (ROLE: admin)
// ======================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ===============================
        //  DASHBOARD
        // ===============================
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        // ===============================
        //  KELOLA ADMIN (CRUD + DELETE)
        // ===============================
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [AdminUserController::class, 'store'])
            ->name('users.store');

        Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/update/{id}', [AdminUserController::class, 'update'])
            ->name('users.update');

        //  DELETE ADMIN (FINAL FIX)
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');


        // ===============================
        //  KELOLA KAMAR
        // ===============================
        Route::get('/kamar', [KamarController::class, 'index'])
            ->name('kamar.index');

        Route::get('/kamar/create', [KamarController::class, 'create'])
            ->name('kamar.create');

        Route::post('/kamar/store', [KamarController::class, 'store'])
            ->name('kamar.store');

        Route::get('/kamar/edit/{id}', [KamarController::class, 'edit'])
            ->name('kamar.edit');

        Route::put('/kamar/update/{id}', [KamarController::class, 'update'])
            ->name('kamar.update');

        Route::delete('/kamar/delete/{id}', [KamarController::class, 'destroy'])
            ->name('kamar.delete');

        Route::get('/kamar/show/{id}', [KamarController::class, 'show'])
            ->name('kamar.show');


        // ===============================
        //  VERIFIKASI PEMBAYARAN
        // ===============================
        Route::get('/verifikasi', [AdminPaymentController::class, 'index'])
            ->name('payment.index');

        Route::post('/verifikasi/{id}', [AdminPaymentController::class, 'verify'])
            ->name('payment.verify');

        Route::post('/verifikasi/tolak/{id}', [AdminPaymentController::class, 'reject'])
            ->name('payment.reject');


        // ===============================
        //  DATA PEMESANAN
        // ===============================
        Route::get('/pemesanan', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/pemesanan/{id}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/pemesanan/{id}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');


        // ===============================
        //  LAPORAN
        // ===============================
        Route::get('/laporan/transaksi', [AdminLaporanController::class, 'transaksi'])
            ->name('laporan.transaksi');

        Route::get('/laporan/kamar', [AdminLaporanController::class, 'kamar'])
            ->name('laporan.kamar');

        //  EXPORT PDF
        Route::get('/laporan/export/transaksi', [AdminLaporanController::class, 'exportTransaksiPDF'])
            ->name('laporan.export.transaksi');

        Route::get('/laporan/export/kamar', [AdminLaporanController::class, 'exportKamarPDF'])
            ->name('laporan.export.kamar');

        // Laporan Pendapatan
        Route::get('/laporan/pendapatan', [AdminLaporanController::class, 'pendapatan'])
            ->name('laporan.pendapatan');

        // ===============================
        //  PROFILE ADMIN
        // ===============================
        Route::get('/profile/edit', [AdminDashboardController::class, 'editProfile'])
            ->name('profile.edit');

        Route::put('/profile/update', [AdminDashboardController::class, 'updateProfile'])
            ->name('profile.update');

        //  DAFTAR KAMAR (Admin view available rooms)
        Route::get('/daftar-kamar', [KamarController::class, 'listKamarTamu'])
            ->name('daftar-kamar');

        // ===============================
        //  NOTIFIKASI ADMIN
        // ===============================
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])
            ->name('notifikasi.index');

        Route::post('/notifikasi/baca/{id}', [NotifikasiController::class, 'markRead'])
            ->name('notifikasi.baca');

        Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'markAllRead'])
            ->name('notifikasi.baca-semua');
    });


// ======================================================
//  TAMU ROUTES (ROLE: tamu)
// ======================================================
Route::middleware(['auth', 'role:tamu'])
    ->prefix('tamu')
    ->name('tamu.')
    ->group(function () {

        Route::get('/dashboard', [TamuController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/kamar-saya', [TamuController::class, 'kamarSaya'])
            ->name('kamar.saya');

        Route::get('/daftar-kamar', [TamuController::class, 'daftarKamar'])
            ->name('daftar-kamar');

        Route::get('/orders/history', [ReservasiController::class, 'riwayat'])
            ->name('orders.history');

        Route::get('/order/{id_kamar}', [ReservasiController::class, 'orderPage'])
            ->name('order.page');

        Route::post('/order/store', [ReservasiController::class, 'store'])
            ->name('order.store');

        Route::get('/kamar', [KamarController::class, 'listKamarTamu'])
            ->name('kamar.list');

        Route::get('/upload-bukti/{reservasi_id}', [PaymentController::class, 'create'])
            ->name('payment.upload.form');

        Route::post('/upload-bukti', [PaymentController::class, 'store'])
            ->name('payment.upload');

        Route::get('/notifikasi', [NotifikasiController::class, 'index'])
            ->name('notifikasi.index');

        Route::post('/notifikasi/baca/{id}', [NotifikasiController::class, 'markRead'])
            ->name('notifikasi.baca');

        Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'markAllRead'])
            ->name('notifikasi.baca-semua');

        // ===============================
        //  PROFILE TAMU
        // ===============================
        Route::get('/profile/edit', [TamuProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile/update', [TamuProfileController::class, 'update'])
            ->name('profile.update');

        // ===============================
        //  BANTUAN / FAQ
        // ===============================
        Route::get('/bantuan', [TamuController::class, 'bantuan'])
            ->name('bantuan');

        // ===============================
        //  PEMBAYARAN
        // ===============================
        Route::get('/pembayaran', [TamuController::class, 'pembayaran'])
            ->name('pembayaran');
    });


