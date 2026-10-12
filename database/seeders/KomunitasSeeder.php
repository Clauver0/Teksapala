<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Komunitas;
use Illuminate\Support\Facades\Hash;

class KomunitasSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $komunitass = [
            [
                'peran' => 'Sekretaris',
                'email'      => 'sekretaris_komunitas@example.com',
                'username'   => 'SekretarisKomunitas',
                'password'   => Hash::make('password'),
                'no_telp'    => '081234567890',
            ],

            [
                'peran' => 'Bendahara',
                'email'      => 'bendahara_komunitas@example.com',
                'username'   => 'BendaharaKomunitas',
                'password'   => Hash::make('password'),
                'no_telp'    => '081234567891',
            ],

            [
                'peran' => 'Divisi Reboisasi',
                'email'      => 'Reboisasi@example.com',
                'username'   => 'AnggotaKomunitas',
                'password'   => Hash::make('password'),
                'no_telp'    => '081234567892',
            ],
            
        ];

        foreach ($komunitass as $komunitas){
            Komunitas::create($komunitas);
        }
    
    }
}