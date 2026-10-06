<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDonasi extends Model
{
    use HasFactory;

    protected $table = 'detail_donasis';
    protected $primaryKey = 'ID_DETAIL_DONASI';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_DETAIL_DONASI',
        'JUMLAH_TANAMAN',
        'ID_DONASI',
        'ID_JADWAL_TANAMAN'
    ];

    /**
     * Auto generate ID_DETAIL_DONASI format DD00000001
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Cek dulu biar gak ketimpa kalau diisi manual
            if (empty($model->ID_DETAIL_DONASI)) {
                $latest = static::orderBy('ID_DETAIL_DONASI', 'desc')->first();
                $nextNumber = 1;

                if ($latest && preg_match('/DD(\d+)/', $latest->ID_DETAIL_DONASI, $matches)) {
                    $nextNumber = intval($matches[1]) + 1; // Ditambah 1 di luar intval
                }

                // Hasil: DD00000001 (Total 10 karakter)
                $model->ID_DETAIL_DONASI = 'DD' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * RELASI 1: Terhubung ke Model Donasi
     */
    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'ID_DONASI', 'ID_DONASI');
    }

    /**
     * RELASI 2: Terhubung ke Model JadwalTanaman
     */
    public function jadwalTanaman()
    {
        return $this->belongsTo(JadwalTanaman::class, 'ID_JADWAL_TANAMAN', 'ID_JADWAL_TANAMAN');
    }
}