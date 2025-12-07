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
            \Database\Seeders\JadwalPosyanduSeeder::class,
            \Database\Seeders\WargaSeeder::class,
        ]);

        // Seeder layanan posyandu (menghubungkan jadwal & warga)
        $this->call([
            \Database\Seeders\LayananPosyanduSeeder::class,
        ]);

        // Seeder baru yang ditambahkan
        $this->call([
            \Database\Seeders\PosyanduSeeder::class,          // Seeder baru untuk Data Posyandu
            \Database\Seeders\CatatanImunisasiSeeder::class,  // Seeder baru untuk Catatan Imunisasi
        ]);
    }
}