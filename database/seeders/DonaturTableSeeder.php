<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donatur;
use Illuminate\Support\Facades\Hash;

class DonaturTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $donaturs = [
            [
                'nama_lengkap' => 'budi santoso',
                'email'        => 'budi@gmail.com',
                'username'     => 'budisantoso',
                'password'     => Hash::make('password123'),
                'no_telp'      => '081234567890',
            ],

            [
                'nama_lengkap' => 'siti aminah',
                'email'        => 'siti@gmail.com',
                'username'     => 'sitiaminah',
                'password'     => Hash::make('password123'),
                'no_telp'      => '082198765432',
            ],

            [
                'nama_lengkap' => 'andrian pratama',
                'email'        => 'andrian@gmail.com',
                'username'     => 'andrianp',
                'password'     => Hash::make('password123'),
                'no_telp'      => '085712345678'
            ],
        ];

        foreach ($donaturs as $donatur){
            Donatur::create($donatur);
        }
        
    }
}