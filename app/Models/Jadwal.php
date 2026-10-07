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
        'deskripsi', 'id_komunitas',
       
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

    protected static function booted()
    {
        static::creating(function ($m) {
            if (empty($m->id_jadwal)) {
                $last = static::orderBy('id_jadwal', 'desc')->value('id_jadwal');
                $n = $last ? (int) substr($last, 1) + 1 : 1;
                $m->id_jadwal = 'J' . str_pad($n, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}


