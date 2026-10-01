<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Komunitas extends Authenticatable
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'komunitas';

    // Primary key kustom
    protected $primaryKey = 'id_komunitas';

    // Set false karena primary key berupa string (bukan auto-increment integer)
    public $incrementing = false;
    protected $keyType = 'string';

    // Nonaktifkan timestamp default Laravel (created_at & updated_at)
    public $timestamps = false;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_komunitas',
        'peran',
        'email',
        'username',
        'password',
        'no_telp',
    ];

    // Sembunyikan kolom password saat data di-convert ke Array / JSON
    protected $hidden = [
        'password',
    ];

    /**
     * Auto-generate ID otomatis dengan format K001 di level Laravel
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id_komunitas)) {
                $latest = static::max('id_komunitas');
                $number = $latest ? ((int) substr($latest, 1)) + 1 : 1;
                $model->id_komunitas = 'K' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
