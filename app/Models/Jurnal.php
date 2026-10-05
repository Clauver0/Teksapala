<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
      use HasFactory;
     // Nama tabel sesuai DDL Oracle
    protected $table = 'JURNAL';

    // Primary key
    protected $primaryKey = 'ID_JURNAL';

    // ID berupa string, bukan angka
    public $incrementing = false;
    protected $keyType = 'string';

    // Karena tabel Oracle tidak memiliki created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'ID_JURNAL',
        'TANGGAL_JURNAL',
        'JUDUL_JURNAL',
        'JENIS_TANAMAN',
        'DESKRIPSI',
        'GAMBAR',
        'ID_KOMUNITAS',
    ];

    /**
     * Relasi JURNAL ke KOMUNITAS
     */
    public function komunitas()
    {
        return $this->belongsTo(
            Komunitas::class,
            'ID_KOMUNITAS',
            'ID_KOMUNITAS'
        );
    }

    /**
     * Membuat ID_JURNAL otomatis
     * Meniru trigger Oracle:
     * JR0001, JR0002, JR0003, ...
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (empty($model->ID_JURNAL)) {

                $latest = static::orderBy('ID_JURNAL', 'desc')->first();

                $nextNumber = 1;

                if (
                    $latest &&
                    preg_match('/JR(\d+)/', $latest->ID_JURNAL, $matches)
                ) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                $model->ID_JURNAL = 'JR' . str_pad(
                    $nextNumber,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
