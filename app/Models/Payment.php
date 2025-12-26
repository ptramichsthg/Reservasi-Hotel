<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'reservasi_id',
        'bukti_pembayaran',
        'status',
        'admin_id',
        'tanggal_upload',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_upload'     => 'datetime',
        'tanggal_verifikasi' => 'datetime',
    ];

    /**
     * RELASI — Payment dimiliki oleh 1 Reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'id_reservasi');
    }

    /**
     * RELASI — Payment diverifikasi oleh Admin
     * admin_id → id_user di tabel users
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id_user');
    }
}
