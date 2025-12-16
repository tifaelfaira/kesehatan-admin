<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder user default
        $this->call([
            PosyanduSeeder::class,
            KaderPosyanduSeeder::class,
            JadwalPosyanduSeeder::class,
            LayananPosyanduSeeder::class,
            CatatanImunisasiSeeder::class,
            CreateFirstUserSeeder::class, // tetap bisa dipanggil terakhir atau pertama sesuai kebutuhan
            WargaSeeder::class,           // optional, tergantung dependensi data
        ]);
    }
}
