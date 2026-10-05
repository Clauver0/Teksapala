<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $primaryKey = 'ID_DONASI';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_DONASI',
        'NOMINAL_DONASI',
        'WAKTU_DONASI',
        'METODE_DONASI',
        'STATUS_VERIFIKASI',
        'BUKTI_DONASI',
        'FILE_SERTIFIKAT',
        'ID_DONATUR'        
    ];

    /**
     * Meniru logika TRIGGER auto-generate ID_DONASI format DN00000001
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Auto generate ID_DONASI format DN00000001 jika kosong
            if (empty($model->ID_DONASI)) {
                $latest = static::orderBy('ID_DONASI', 'desc')->first();
                $nextNumber = 1;

                if ($latest && preg_match('/DN(\d+)/', $latest->ID_DONASI, $matches)) {
                    $nextNumber = intval($matches[1]) + 1;
                }

                // Generates DN00000001, DN00000002, dst. (Total 10 karakter sesuai limit varchar 10)
                $model->ID_DONASI = 'DN' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relasi ke model Donatur (BelongsTo)
     */
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'ID_DONATUR', 'ID_DONATUR');
    }
}