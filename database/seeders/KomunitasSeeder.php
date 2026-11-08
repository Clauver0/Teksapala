<?php

namespace Database\Seeders;

use App\Models\Komunitas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KomunitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_komunitas' => 'Komunitas Hijau Lestari',
                'display_name'   => 'Hijau Lestari',
                'email'          => 'hijaulestari@example.com',
                'username'       => 'hijaulestari',
                'no_telp'        => '081234567801',
            ],
            [
                'nama_komunitas' => 'Pecinta Pohon Nusantara',
                'display_name'   => 'Pecinta Pohon',
                'email'          => 'pecintapohon@example.com',
                'username'       => 'pecintapohon',
                'no_telp'        => '081234567802',
            ],
            [
                'nama_komunitas' => 'Gerakan Tanam Bersama',
                'display_name'   => 'Tanam Bersama',
                'email'          => 'tanambersama@example.com',
                'username'       => 'tanambersama',
                'no_telp'        => '081234567803',
            ],
        ];

        foreach ($data as $row) {
            // updateOrCreate supaya seeder aman dijalankan berulang kali
            Komunitas::updateOrCreate(
                ['username' => $row['username']],
                $row + ['password' => Hash::make('password123')]
            );
        }
    }
}