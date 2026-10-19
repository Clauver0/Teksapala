<?php

namespace Database\Seeders;

use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donaturIds = Donatur::pluck('id_donatur')->all();

        if (empty($donaturIds)) {
            $this->command->warn('Tabel donatur kosong. Jalankan DonaturSeeder terlebih dahulu.');
            return;
        }

        $data = [
            [
                'nominal_donasi'    => 50000,
                'waktu_donasi'      => '2026-09-01 09:15:00',
                'metode_donasi'     => 'Transfer Bank',
                'status_verifikasi' => 'Terverifikasi',
                'bukti_donasi'      => 'bukti/donasi-001.jpg',
                'file_sertifikat'   => 'sertifikat/donasi-001.pdf',
            ],
            [
                'nominal_donasi'    => 100000,
                'waktu_donasi'      => '2026-09-05 13:40:00',
                'metode_donasi'     => 'QRIS',
                'status_verifikasi' => 'Terverifikasi',
                'bukti_donasi'      => 'bukti/donasi-002.jpg',
                'file_sertifikat'   => 'sertifikat/donasi-002.pdf',
            ],
            [
                'nominal_donasi'    => 250000,
                'waktu_donasi'      => '2026-09-12 19:05:00',
                'metode_donasi'     => 'E-Wallet',
                'status_verifikasi' => 'Pending',
                'bukti_donasi'      => 'bukti/donasi-003.jpg',
                'file_sertifikat'   => null,
            ],
            [
                'nominal_donasi'    => 75000,
                'waktu_donasi'      => '2026-09-20 11:30:00',
                'metode_donasi'     => 'Transfer Bank',
                'status_verifikasi' => 'Ditolak',
                'bukti_donasi'      => 'bukti/donasi-004.jpg',
                'file_sertifikat'   => null,
            ],
            [
                'nominal_donasi'    => 500000,
                'waktu_donasi'      => '2026-10-02 16:20:00',
                'metode_donasi'     => 'QRIS',
                'status_verifikasi' => 'Pending',
                'bukti_donasi'      => 'bukti/donasi-005.jpg',
                'file_sertifikat'   => null,
            ],
        ];

        foreach ($data as $index => $item) {
            // Bagi rata donatur secara bergiliran
            $item['id_donatur'] = $donaturIds[$index % count($donaturIds)];

            Donasi::create($item);
        }
    }
}
