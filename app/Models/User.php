<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Custom Primary Key (karena nama PK = id_user)
     */
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Kolom yang bisa diisi
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Relasi: User memiliki banyak Reservasi
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_user', 'id_user');
    }

    /**
     * Relasi: User sebagai ADMIN memverifikasi banyak payment
     */
    public function verifikasiPembayaran()
    {
        return $this->hasMany(Payment::class, 'admin_id', 'id_user');
    }
}
