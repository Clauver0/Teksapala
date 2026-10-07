<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTanaman extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tanaman';

   
    protected $primaryKey = 'id_jadwal_tanaman';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
    'id_jadwal_tanaman',
    'harga',
    'kouta',        
    'terdonasi',
    'id_jadwal',
    'id_tanaman',
];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

     public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman', 'id_tanaman');
    }
    
    protected static function booted()
    {
        static::creating(function ($m) {
            if (empty($m->id_jadwal_tanaman)) {
                $last = static::orderBy('id_jadwal_tanaman', 'desc')->value('id_jadwal_tanaman');
                $n = $last ? (int) substr($last, 2) + 1 : 1;  
                $m->id_jadwal_tanaman = 'JT' . str_pad($n, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
