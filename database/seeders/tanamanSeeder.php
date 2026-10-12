<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tanaman;
use Illuminate\Support\Facades\Hash;

class TanamanSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $tanamans = [
            [
                'nama_tanaman' => 'Pinus',
                'gambar'        => 'Pinus.jpg',
            ],

            [
                'nama_tanaman' => 'Srikaya',
                'gambar'        => 'Srikaya.jpg',
            ],

            [
                'nama_tanaman' => 'Mangga',
                'gambar'        => 'Mangga.jpg',
            ],
        ];

        foreach ($tanamans as $tanaman){
            Tanaman::create($tanaman);
        }
    
    }
}