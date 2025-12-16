<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder user default
        $this->call([
            CreateFirstUserSeeder::class, // tetap bisa dipanggil terakhir atau pertama sesuai kebutuhan
            WargaSeeder::class,
            PosyanduSeeder::class,
            KaderPosyanduSeeder::class,
            JadwalPosyanduSeeder::class,
            LayananPosyanduSeeder::class,
            CatatanImunisasiSeeder::class,
        ]);
    }
}
