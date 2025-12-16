<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KaderPosyandu;
use App\Models\Posyandu;
use App\Models\Warga;
use Faker\Factory as Faker;

class KaderPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID posyandu & warga
        $posyanduIds = Posyandu::pluck('posyandu_id')->toArray();
        $wargaIds    = Warga::pluck('id')->toArray();

        // Kalau data master belum ada
        if (empty($posyanduIds) || empty($wargaIds)) {
            $this->command->warn('Seeder dibatalkan: data posyandu atau warga kosong');
            return;
        }

        $peranList = [
            'Ketua',
            'Sekretaris',
            'Bendahara',
            'Kader Imunisasi',
            'Kader Gizi',
            'Kader Kesehatan Ibu & Anak',
        ];

        for ($i = 1; $i <= 100; $i++) {
            $mulai = $faker->dateTimeBetween('-5 years', '-1 year');

            // 70% masih aktif (akhir_tugas null)
            $akhir = $faker->boolean(70)
                ? null
                : $faker->dateTimeBetween($mulai, 'now');

            KaderPosyandu::create([
                'posyandu_id' => $faker->randomElement($posyanduIds),
                'warga_id'    => $faker->randomElement($wargaIds),
                'peran'       => $faker->randomElement($peranList),
                'mulai_tugas' => $mulai->format('Y-m-d'),
                'akhir_tugas' => $akhir ? $akhir->format('Y-m-d') : null,
            ]);
        }

        $this->command->info('Seeder Kader Posyandu: 100 data berhasil dibuat');
    }
}
