<?php

namespace Database\Seeders;

use App\Models\Jurnal;
use Illuminate\Database\Seeder;

class JurnalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul_jurnal'   => 'Awal Penanaman Cabai Rawit',
                'jenis_tanaman'  => 'Cabai Rawit',
                'deskripsi'      => 'Benih cabai rawit disemai di polybag dengan media tanah dan pupuk kompos.',
                'gambar'         => 'jurnal/cabai-rawit.jpg',
                'tanggal_jurnal' => '2026-09-01',
            ],
            [
                'judul_jurnal'   => 'Perawatan Tomat Minggu Kedua',
                'jenis_tanaman'  => 'Tomat',
                'deskripsi'      => 'Penyiraman rutin pagi hari dan pemasangan ajir agar batang tidak roboh.',
                'gambar'         => 'jurnal/tomat.jpg',
                'tanggal_jurnal' => '2026-09-08',
            ],
            [
                'judul_jurnal'   => 'Panen Perdana Selada',
                'jenis_tanaman'  => 'Selada',
                'deskripsi'      => 'Selada hidroponik siap panen setelah 35 hari masa tanam.',
                'gambar'         => 'jurnal/selada.jpg',
                'tanggal_jurnal' => '2026-09-15',
            ],
            [
                'judul_jurnal'   => 'Pengendalian Hama pada Terong',
                'jenis_tanaman'  => 'Terong',
                'deskripsi'      => null,
                'gambar'         => 'jurnal/terong.jpg',
                'tanggal_jurnal' => '2026-09-22',
            ],
            [
                'judul_jurnal'   => 'Pemindahan Bibit Kangkung',
                'jenis_tanaman'  => 'Kangkung',
                'deskripsi'      => 'Bibit dipindahkan dari tray semai ke bedengan setelah muncul 4 daun.',
                'gambar'         => 'jurnal/kangkung.jpg',
                'tanggal_jurnal' => '2026-10-01',
            ],
        ];

        foreach ($data as $item) {
            Jurnal::create($item);
        }
    }
}