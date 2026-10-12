<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\JadwalTanaman;
use App\Models\Tanaman;
use Illuminate\Database\Seeder;

class JadwalTanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalIds  = Jadwal::pluck('id_jadwal')->all();
        $tanamanIds = Tanaman::pluck('id_tanaman')->all();

        if (empty($jadwalIds) || empty($tanamanIds)) {
            $this->command->warn('Tabel jadwal atau tanaman kosong. Jalankan JadwalSeeder dan TanamanSeeder terlebih dahulu.');
            return;
        }

        $data = [
            ['harga' => 25000,  'kouta' => 100, 'terdonasi' => 40],
            ['harga' => 35000,  'kouta' => 80,  'terdonasi' => 80],
            ['harga' => 50000,  'kouta' => 60,  'terdonasi' => 15],
            ['harga' => 75000,  'kouta' => 40,  'terdonasi' => 0],
            ['harga' => 100000, 'kouta' => 30,  'terdonasi' => 12],
            ['harga' => 20000,  'kouta' => 150, 'terdonasi' => 95],
        ];

        foreach ($data as $index => $item) {
            // Bergiliran supaya kombinasi jadwal & tanaman bervariasi
            $item['id_jadwal']  = $jadwalIds[$index % count($jadwalIds)];
            $item['id_tanaman'] = $tanamanIds[$index % count($tanamanIds)];

            JadwalTanaman::create($item);
        }
    }
}