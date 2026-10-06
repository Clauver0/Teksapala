
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTanaman extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tanamen';

   
    protected $primaryKey = 'id_jadwal_tanaman';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_jadwal_tanaman',
        'id_jadwal',
        'nama_tanaman',
        'jumlah_bibit',
        'status_tanam',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }
}
