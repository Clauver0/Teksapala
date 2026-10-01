<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    // Nama tabel sesuai DDL Oracle
    protected $table = 'TANAMAN';

    // Primary key
    protected $primaryKey = 'ID_TANAMAN';

    // ID berupa string, bukan angka
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang boleh diisi
    protected $fillable = [
        'ID_TANAMAN',
        'NAMA',
        'GAMBAR',
    ];

    /**
     * Meniru logika TRIGGER trg_tanaman_id
     * dan SEQUENCE seq_tanaman
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            // Jika ID_TANAMAN kosong, buat otomatis
            if (empty($model->ID_TANAMAN)) {

                // Ambil data terakhir
                $latest = static::orderBy('ID_TANAMAN', 'desc')->first();

                $nextNumber = 1;

                if ($latest && preg_match('/T(\d+)/', $latest->ID_TANAMAN, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                // Format: T001, T002, T003, ...
                $model->ID_TANAMAN = 'T' . str_pad(
                    $nextNumber,
                    3,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
