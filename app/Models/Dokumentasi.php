<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi';
    protected $primaryKey = 'id_dokumentasi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_dokumentasi',
        'link_gdrive',
        'judul_dokumentasi',
        'tanggal_unggah',
        'deskripsi',
        'id_jadwal',
        'id_komunitas',
    ];

    protected $casts = [
        'tanggal_unggah' => 'datetime',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id_dokumentasi)) {
                $latest = static::max('id_dokumentasi');
                $number = $latest ? ((int) substr($latest, 3)) + 1 : 1;
                $model->id_dokumentasi = 'DOC' . str_pad((string) $number, 4, '0', STR_PAD_LEFT);
            }

            if (empty($model->tanggal_unggah)) {
                $model->tanggal_unggah = now();
            }
        });
    }
}