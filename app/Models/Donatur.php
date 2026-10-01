<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    // Nama tabel sesuai DDL
    protected $table = 'DONATUR';

    // Primary key non-incrementing string
    protected $primaryKey = 'ID_DONATUR';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_DONATUR',
        'NAMA_LENGKAP',
        'EMAIL',
        'USERNAME',
        'PASSWORD',
        'NO_TELP',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    /**
     * Meniru logika TRIGGER trg_donatur_id dan SEQUENCE Oracle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Auto generate ID_DONATUR format D00001 jika kosong
            if (empty($model->ID_DONATUR)) {
                $latest = static::orderBy('ID_DONATUR', 'desc')->first();
                $nextNumber = 1;

                if ($latest && preg_match('/D(\d+)/', $latest->ID_DONATUR, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                $model->ID_DONATUR = 'D' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            }
        });

        // Meniru INITCAP pada INSERT maupun UPDATE
        static::saving(function ($model) {
            if (!empty($model->NAMA_LENGKAP)) {
                $model->NAMA_LENGKAP = ucwords(strtolower($model->NAMA_LENGKAP));
            }
        });
    }
}