<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'donatur';

    // Primary key
    protected $primaryKey = 'id_donatur';

    // ID berupa string, bukan auto increment
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
     * Generate ID otomatis:
     * D00001
     * D00002
     * D00003
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (empty($model->id_donatur)) {

                $latest = static::orderBy('id_donatur', 'desc')->first();

                $nextNumber = 1;

                if ($latest) {
                    $nextNumber =
                        ((int) substr($latest->id_donatur, 1)) + 1;
                }

                $model->id_donatur =
                    'D' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            }
        });

        // Mengubah nama menjadi format "Budi Santoso"
        static::saving(function ($model) {

            if (!empty($model->nama_lengkap)) {
                $model->nama_lengkap =
                    ucwords(strtolower($model->nama_lengkap));
            }
        });
    }
}