<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservasi;

class Kamars extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'tipe_kamar',
        'harga',
        'kapasitas',
        'status',
        'foto_utama',
        'deskripsi',
        'fasilitas',
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'kapasitas' => 'integer',
    ];

    public $timestamps = true;

    /**
     * ⭐ PERBAIKAN PENTING
     * Pastikan fasilitas SELALU berupa array
     * Aman untuk:
     * - whereJsonContains
     * - implode() di blade
     * - PDF export
     */
    public function getFasilitasAttribute($value)
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        // Jika sudah array (hasil cast)
        if (is_array($value)) {
            return $value;
        }

        // Jika masih string JSON
        $json = json_decode($value, true);

        return is_array($json) ? $json : [];
    }

    /**
     * Relasi: Kamar memiliki banyak reservasi
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar', 'id_kamar');
    }
}
