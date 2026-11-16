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
                'gambar'        => 'https://www.conifers.org/pi/pi/n/nigra09.jpg',
            ],

            [
                'nama_tanaman' => 'Srikaya',
                'gambar'        => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRihXEyHWfA-r-XeCNhDZyZ8WdeNtP-Nocu9a33L6IDbiYQilowHf2D2lnJ&s=10',
            ],

            [
                'nama_tanaman' => 'Mangga',
                'gambar'        => 'https://gkmdblog.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2023/12/16193752/Blog-Mangga-Indonsia.jpeg',
            ],
        ];

        foreach ($tanamans as $tanaman){
            Tanaman::create($tanaman);
        }
    
    }
}