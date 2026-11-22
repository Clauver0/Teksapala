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
        'metode_donasi',
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
          if (empty($model->id_donasi)) {
             $latest = static::lockForUpdate()
                 ->orderBy('id_donasi', 'desc')
                 ->value('id_donasi');

             $nextNumber = $latest && preg_match('/DN(\d+)/', $latest, $matches)
                  ? intval($matches[1]) + 1
                 : 1;

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
    public function detailDonasis()
{
    return $this->hasMany(DetailDonasi::class, 'id_donasi', 'id_donasi');
}
}