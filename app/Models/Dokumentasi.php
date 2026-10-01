<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'dokumentasi';

    // Primary key kustom
    protected $primaryKey = 'id_dokumentasi';

    // Set false karena primary key berupa String (bukan auto-increment integer)
    public $incrementing = false;
    protected $keyType = 'string';

    // Nonaktifkan timestamp default Laravel (created_at & updated_at)
    public $timestamps = false;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_dokumentasi',
        'file_foto',
        'judul_foto',
        'tanggal_unggah',
        'deskripsi',
        'id_jadwal',
        'id_komunitas',
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal_unggah' => 'datetime',
    ];

    // Relasi ke model Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    // Relasi ke model Komunitas
    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id_dokumentasi)) {
                // Mengambil urutan atau membuat format DOC0001
                $latest = static::max('id_dokumentasi');
                $number = $latest ? ((int) substr($latest, 3)) + 1 : 1;
                $model->id_dokumentasi = 'DOC' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}