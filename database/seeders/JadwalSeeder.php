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
                'status_pelaksanaan'  => 'terjadwal',
                'lokasi_pelaksanaan'  => 'Desa Penari',
                'tanggal_pelaksanaan' => '2026-11-20',
                'deskripsi'           => 'Kegiatan penanaman pohon di Desa Penari.',
                'jumlah_peserta'      => 50,
                'id_komunitas'        => 'K001', // Sesuaikan dengan ID komunitas yang ada di database kalian
                'is_archived'         => 0, // Belum di-archive
                'gambar'              =>'https://img.freepik.com/premium-photo/group-planting-mangrove-trees-along-coastline_41097-16224.jpg?w=1380'
            ],
            [
                'status_pelaksanaan'  => 'berlangsung',
                'lokasi_pelaksanaan'  => 'Pantai Drini',
                'tanggal_pelaksanaan' => '2026-10-12',
                'deskripsi'           => 'Kegiatan penanaman pohon di Pantai Drini.',
                'jumlah_peserta'      => 30,
                'id_komunitas'        => 'K001',
                'is_archived'         => 0,
                'gambar'              =>'https://tse4.mm.bing.net/th/id/OIP.tp0mdH1xBRrCs4A8wMWP1AHaEc?r=0&rs=1&pid=ImgDetMain&o=7&rm=3'
            ],
            [
                'status_pelaksanaan'  => 'Selesai',
                'lokasi_pelaksanaan'  => 'Pantai Parangtritis',
                'tanggal_pelaksanaan' => '2026-09-15',
                'deskripsi'           => 'Kegiatan penanaman pohon di Pantai Parangtritis.',
                'jumlah_peserta'      => 75,
                'id_komunitas'        => 'K002',
                'is_archived'         => 1, // Contoh data yang sudah di-archive
                'gambar'              =>'https://blog.alfagift.id/wp-content/uploads/2025/01/jeruk-mandarin-1-1.jpg'
            ],
        ];

        foreach ($jadwal as $item) {
            Jadwal::create($item);
        }
    }
}