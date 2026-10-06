<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        
        'status_pelaksanaan',
        'lokasi_pelaksanaan',
        'tanggal_pelaksanaan',
        'deskripsi',
       
    ];

public function jadwalTanamans()
    {
        return $this->hasMany(JadwalTanaman::class, 'id_jadwal', 'id_jadwal');
    }

    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    public function dokumentasis()
    {
        return $this->hasMany(Dokumentasi::class, 'id_jadwal', 'id_jadwal');
    }

}
