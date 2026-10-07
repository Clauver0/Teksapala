<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    // Nama tabel sesuai DDL Oracle
    protected $table = 'tanaman';

    // Primary key
    protected $primaryKey = 'id_tanaman';

    // ID berupa string, bukan angka
    public $incrementing = false;
    protected $keyType = 'string';

      
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_tanaman',
        'nama_tanaman',
        'gambar',
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
            if (empty($model->id_tanaman)) {

                // Ambil data terakhir
                $latest = static::orderBy('id_tanaman', 'desc')->first();

                $nextNumber = 1;

                if ($latest && preg_match('/T(\d+)/', $latest->id_tanaman, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                // Format: T001, T002, T003, ...
                $model->id_tanaman = 'T' . str_pad(
                    $nextNumber,
                    3,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
