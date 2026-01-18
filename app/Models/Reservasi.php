<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'id_kamar',
        'tgl_checkin',
        'jam_checkin',      // Jam check-in (default 14:00)
        'tgl_checkout',
        'jam_checkout',     // Jam check-out (default 12:00)
        'status_pembayaran',   // pending, verified, rejected
        'status_reservasi',    // pending, confirmed, cancelled
        'jumlah_tamu',
        'total_harga',
    ];

    protected $casts = [
        'tgl_checkin'  => 'date',
        'tgl_checkout' => 'date',
    ];

    /* ============================================================
     * RELASI USER (1 reservasi dimiliki 1 user)
     * ============================================================
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /* ============================================================
     * RELASI KAMAR (1 reservasi memilih 1 kamar)
     * ============================================================
     */
    public function kamar()
    {
        return $this->belongsTo(Kamars::class, 'id_kamar');
    }

    /* ============================================================
     * RELASI PEMBAYARAN (1 reservasi punya 1 pembayaran)
     * ============================================================
     */
    public function pembayaran()
    {
        return $this->hasOne(Payment::class, 'reservasi_id');
    }

    /* ============================================================
     * RELASI NOTIFIKASI (1 reservasi menghasilkan banyak notifikasi)
     * ============================================================
     */
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'reservasi_id');
    }

    /* ============================================================
     * 🟢 HITUNG TOTAL HARGA OTOMATIS
     * ============================================================
     */
    public function hitungTotalHarga()
    {
        if (!$this->kamar) {
            return 0;
        }

        $checkin  = Carbon::parse($this->tgl_checkin);
        $checkout = Carbon::parse($this->tgl_checkout);

        $lama = $checkin->diffInDays($checkout);

        if ($lama == 0) {
            $lama = 1; // minimal 1 malam
        }

        return $lama * $this->kamar->harga;
    }

    /* ============================================================
     * 🟢 SIMPAN TOTAL HARGA OTOMATIS (EVENT: saving)
     * ============================================================
     */
    protected static function booted()
    {
        static::saving(function ($reservasi) {
            if ($reservasi->tgl_checkin && $reservasi->tgl_checkout) {
                $reservasi->total_harga = $reservasi->hitungTotalHarga();
            }
        });
    }
}
