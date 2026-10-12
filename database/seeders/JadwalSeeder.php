<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $jadwal = [
            [
               
                'status_pelaksanaan' => 'terjadwal',
                'lokasi_pelaksanaan'        => 'Desa Penari',
                'tanggal_pelaksanaan'=> '2026-11-20',
                'deskripsi' => 'Kegiatan penanaman pohon di Desa Penari.'

            ],

            [
                'status_pelaksanaan' => 'berlangsung',
                'lokasi_pelaksanaan'        => 'pantai Drini',
                'tanggal_pelaksanaan'=> '2026-10-12',
                'deskripsi' => 'Kegiatan penanaman pohon di pantai Drini.'

            ],

            ['status_pelaksanaan' => 'Selesai',
                'lokasi_pelaksanaan'        => 'Pantai Parangkritis',
                'tanggal_pelaksanaan'=> '2026-09-15',
                'deskripsi' => 'Kegiatan penanaman pohon di pantai Parangkritis.'

            ],
        ];

        foreach ($jadwal as $jadwal){
            Jadwal::create($jadwal);
        }
    
    }
}