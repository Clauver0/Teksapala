<?php

namespace Database\Seeders;

use App\Models\DetailDonasi;
use App\Models\Donasi;
use App\Models\JadwalTanaman;
use Illuminate\Database\Seeder;

class DetailDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donasiIds         = Donasi::pluck('id_donasi')->all();
        $jadwalTanamanIds  = JadwalTanaman::pluck('id_jadwal_tanaman')->all();

        if (empty($donasiIds) || empty($jadwalTanamanIds)) {
            $this->command->warn('Tabel donasi atau jadwal_tanaman kosong. Jalankan DonasiSeeder dan JadwalTanamanSeeder terlebih dahulu.');
            return;
        }

        $jumlahTanaman = [2, 5, 1, 10, 3, 4, 6, 2];

        foreach ($donasiIds as $i => $idDonasi) {
            // Tiap donasi punya 1-2 detail dengan jadwal tanaman berbeda
            $banyakDetail = ($i % 2 === 0) ? 2 : 1;

            for ($j = 0; $j < $banyakDetail; $j++) {
                DetailDonasi::create([
                    'jumlah_tanaman'    => $jumlahTanaman[($i + $j) % count($jumlahTanaman)],
                    'id_donasi'         => $idDonasi,
                    'id_jadwal_tanaman' => $jadwalTanamanIds[($i + $j) % count($jadwalTanamanIds)],
                ]);
            }
        }
    }
}