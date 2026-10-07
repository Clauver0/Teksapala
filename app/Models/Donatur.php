<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    // Nama tabel sesuai DDL
    protected $table = 'donatur';

    // Primary key non-incrementing string
    protected $primaryKey = 'id_donatur';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_donatur',
        'nama_lengkap',
        'email',
        'username',
        'password',
        'no_telp',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Meniru logika TRIGGER trg_donatur_id dan SEQUENCE Oracle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Auto generate ID_DONATUR format D00001 jika kosong
            if (empty($model->id_donatur)) {
                $latest = static::orderBy('id_donatur', 'desc')->first();
                $nextNumber = 1;

                if ($latest && preg_match('/D(\d+)/', $latest->id_donatur, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                $model->id_donatur = 'D' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            }
        });

        // Meniru INITCAP pada INSERT maupun UPDATE
        static::saving(function ($model) {
            if (!empty($model->nama_lengkap)) {
                $model->nama_lengkap = ucwords(strtolower($model->nama_lengkap));
            }
        });
    }
}