<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
      use HasFactory;
     // Nama tabel sesuai DDL Oracle
    protected $table = 'jurnal';

    // Primary key
    protected $primaryKey = 'id_jurnal';

    // ID berupa string, bukan angka
    public $incrementing = false;
    protected $keyType = 'string';

    // Karena tabel Oracle tidak memiliki created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'tanggal_jurnal',
        'judul_jurnal',
        'jenis_tanaman',
        'deskripsi',
        'gambar',
        'id_komunitas',
    ];

    /**
     * Relasi JURNAL ke KOMUNITAS
     */
    public function komunitas()
    {
        return $this->belongsTo(
            Komunitas::class,
            'id_komunitas',
            'id_komunitas'
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

            if (empty($model->id_jurnal)) {

                $latest = static::orderBy('id_jurnal', 'desc')->first();

                $nextNumber = 1;

                if (
                    $latest &&
                    preg_match('/JR(\d+)/', $latest->id_jurnal, $matches)
                ) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                $model->id_jurnal = 'JR' . str_pad(
                    $nextNumber,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }
}
