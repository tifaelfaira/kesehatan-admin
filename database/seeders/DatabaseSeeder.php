<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder user default
        $this->call([
            \Database\Seeders\CreateFirstUserSeeder::class,
        ]);

        // Seeder jadwal & warga
        $this->call([
            \Database\Seeders\JadwalKesehatanSeeder::class,
            \Database\Seeders\WargaSeeder::class,
        ]);

        // Seeder layanan posyandu (menghubungkan jadwal & warga)
        $this->call([
            \Database\Seeders\LayananPosyanduSeeder::class,
        ]);
    }
}
