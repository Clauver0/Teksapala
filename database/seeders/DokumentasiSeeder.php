<?php

namespace Database\Seeders;

use App\Models\Dokumentasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokumentasiSeeder extends Seeder
{
    // /**
    //  * Run the database seeds.
    //  */ meow
    public function run(): void
    {
        $dokumentasis = [
            [
                'file_foto'      => 'https://lh3.googleusercontent.com/d/1rEdvyN1z7_Kfm5mf5DwXZslwWJS3ck3Q', // Ganti ID file GDrive-mu
                'judul_foto'     => 'DOCA01',
                'tanggal_unggah' => '2026-06-01 10:00:00',
                'deskripsi'      => 'lorem ipsum dolor sit amet',
                'id_jadwal'      => 'J0002',   
                'id_komunitas'   => 'K002',
                ],
            [
                'file_foto'      => 'https://lh3.googleusercontent.com/d/1X40FxRusnIiWymkoOjSdbGRxY7nrP61F',
                'judul_foto'     => 'DOCA02',
                'tanggal_unggah' => '2026-06-01 10:00:00',
                'deskripsi'      => 'consectetur adipiscing elit.',
                'id_jadwal'      => 'J0001',
                'id_komunitas'   => 'K001',
            ],
            [
                'file_foto'      => 'https://lh3.googleusercontent.com/d/1BVsOfMhW8c5cLOZkUNtpvnPknSgboLLv',
                'judul_foto'     => 'DOCB01',
                'tanggal_unggah' => '2026-06-03 10:00:00',
                'deskripsi'      => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'id_jadwal'      => 'J0001',
                'id_komunitas'   => 'K001',
            ]
        ];

        foreach ($dokumentasis as $dokumentasi){
            Dokumentasi::create($dokumentasi);
        }
    }
}

