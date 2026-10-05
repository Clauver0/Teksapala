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
                'NAMA_LENGKAP' => 'budi santoso',
                'EMAIL'        => 'budi@gmail.com',
                'USERNAME'     => 'budisantoso',
                'PASSWORD'     => Hash::make('password123'),
                'NO_TELP'      => '081234567890',
            ],

            [
                'NAMA_LENGKAP' => 'SITI AMINAH',
                'EMAIL'        => 'siti@gmail.com',
                'USERNAME'     => 'sitiaminah',
                'PASSWORD'     => Hash::make('password123'),
                'NO_TELP'      => '082198765432',
            ],

            [
                'NAMA_LENGKAP' => 'andrian pratama',
                'EMAIL'        => 'andrian@gmail.com',
                'USERNAME'     => 'andrianp',
                'PASSWORD'     => Hash::make('password123'),
                'NO_TELP'      => '085712345678'
            ],
        ];

        foreach ($donaturs as $donatur){
            Donatur::create($donatur);
        }
        
    }
}