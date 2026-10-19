<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $primaryKey = 'id_donasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_donasi',
        'nominal_donasi',
        'waktu_donasi',
        'metode_donansi',
        'status_verifikasi',
        'bukti_donasi',
        'file_sertifikat',
        'id_donatur'        
    ];

    /**
     * Meniru logika TRIGGER auto-generate ID_DONASI format DN00000001
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Auto generate ID_DONASI format DN00000001 jika kosong
            if (empty($model->id_donasi)) {
                $latest = static::orderBy('id_donasi', 'desc')->first();
                $nextNumber = 1;

                if ($latest && preg_match('/DN(\d+)/', $latest->id_donasi, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                // Generates DN00000001, DN00000002, dst. (Total 10 karakter sesuai limit varchar 10)
                $model->id_donasi = 'DN' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relasi ke model Donatur (BelongsTo)
     */
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }
}