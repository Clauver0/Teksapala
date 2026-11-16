<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Jadwal extends Model
{
    use SoftDeletes;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'status_pelaksanaan',
        'lokasi_pelaksanaan',
        'tanggal_pelaksanaan',
        'deskripsi',
        'id_komunitas',
        'gambar',
        'jumlah_peserta',
        'is_archived',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'is_archived'         => 'boolean',
    ];

    protected static function booted(): void
    {
        // id_jadwal bukan auto-increment, jadi dibuat otomatis saat data dibuat.
        static::creating(function (Jadwal $jadwal) {
            $jadwal->id_jadwal ??= static::buatId();
        });
    }

    /** Format: JDW0000001 (10 karakter, sesuai string('id_jadwal', 10)). */
    protected static function buatId(): string
    {
        $terakhir = static::withTrashed()->orderByDesc('id_jadwal')->value('id_jadwal');
        $nomor = $terakhir ? ((int) substr($terakhir, 3)) + 1 : 1;

        return 'J' . str_pad((string) $nomor, 4, '0', STR_PAD_LEFT);
    }

    public function scopeTidakDiarsipkan($query)
    {
        return $query->where('is_archived', false);
    }

    protected function gambarUrl(): Attribute
    {
        return Attribute::get(fn () => Storage::url($this->gambar));
    }

    public function jadwalTanaman(): HasMany
    {
        return $this->hasMany(JadwalTanaman::class, 'id_jadwal', 'id_jadwal');
    }

    /**
     * Total donasi = jumlah (harga x terdonasi) dari semua tanaman di jadwal ini.
     * Tabel donasi sendiri belum punya kolom penghubung ke jadwal, jadi angka diambil dari jadwal_tanaman.
     */
    protected function totalDonasi(): Attribute
    {
        return Attribute::get(
            fn () => (float) $this->jadwalTanaman->sum(fn (JadwalTanaman $jt) => $jt->nominal_terdonasi)
        );
    }
}
