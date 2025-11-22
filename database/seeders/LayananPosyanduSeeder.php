<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class LayananPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('layanan_posyandu')->delete();

        $jadwals = JadwalPosyandu::all();
        $wargas = Warga::all();

        if ($jadwals->isEmpty() || $wargas->isEmpty()) {
            $this->command->info('Tidak ada data jadwal atau warga untuk membuat layanan posyandu!');
            return;
        }

        $vitamins = ['Vitamin A', 'Vitamin C', 'Vitamin D', 'Vitamin B Kompleks', 'Zinc', 'Iron', 'Multivitamin'];
        $konselingOptions = [
            'Gizi seimbang untuk balita',
            'ASI eksklusif',
            'MPASI sehat',
            'Pola tidur bayi',
            'Stimulasi tumbuh kembang',
            'Pencegahan stunting',
            'Kesehatan ibu hamil',
            'Imunisasi lengkap',
            'Kebersihan diri',
            'Pencegahan penyakit',
        ];

        $layananData = [];

        for ($i = 0; $i < 100; $i++) {
            $jadwal = $jadwals->random();
            $warga = $wargas->random();
            
            $layananData[] = [
                'jadwal_id' => $jadwal->jadwal_id,
                'warga_id' => $warga->id,
                'berat' => rand(30, 800) / 10, // 3.0 - 80.0 kg
                'tinggi' => rand(50, 180), // 50 - 180 cm
                'vitamin' => $vitamins[array_rand($vitamins)],
                'konseling' => $konselingOptions[array_rand($konselingOptions)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert setiap 20 data untuk menghindari memory limit
            if (($i + 1) % 20 === 0) {
                LayananPosyandu::insert($layananData);
                $layananData = [];
            }
        }

        // Insert sisa data
        if (!empty($layananData)) {
            LayananPosyandu::insert($layananData);
        }

        $this->command->info('Seeder Layanan Posyandu berhasil dengan 100 data!');
    }
}