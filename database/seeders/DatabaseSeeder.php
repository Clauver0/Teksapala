<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([DonaturTableSeeder::class]);
        $this->call([JurnalSeeder::class]);
        $this->call([DonasiSeeder::class]);
        $this->call([tanamanSeeder::class]);
        $this->call([JadwalSeeder::class]);
        $this->call([JadwalTanamanSeeder::class]);
        $this->call([DetailDonasiSeeder::class]);
    }
}