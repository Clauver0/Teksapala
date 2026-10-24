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
                'is_archived'         => 0,
                'gambar'              => 'https://static.vecteezy.com/system/resources/thumbnails/057/047/715/small_2x/beautiful-nature-photo.jpg',
            ],
            [
                'status_pelaksanaan'  => 'berlangsung',
                'lokasi_pelaksanaan'  => 'Pantai Drini',
                'tanggal_pelaksanaan' => '2026-10-12',
                'deskripsi'           => 'Kegiatan penanaman pohon di Pantai Drini.',
                'jumlah_peserta'      => 30,
                'id_komunitas'        => 'K001',
                'is_archived'         => 0,
                'gambar'              => 'https://wallup.net/wp-content/uploads/2016/01/132930-nature-landscape-flowers.jpg',
            ],
            [
                'status_pelaksanaan'  => 'Selesai',
                'lokasi_pelaksanaan'  => 'Pantai Parangtritis',
                'tanggal_pelaksanaan' => '2026-09-15',
                'deskripsi'           => 'Kegiatan penanaman pohon di Pantai Parangtritis.',
                'jumlah_peserta'      => 75,
                'id_komunitas'        => 'K002',
                'is_archived'         => 1,
                'gambar'              => 'https://wallpaperaccess.com/full/101952.jpg',
            ],
        ];

        foreach ($jadwal as $item) {
            Jadwal::create($item);
        }
    }
}