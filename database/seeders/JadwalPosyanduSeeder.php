<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPosyandu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_posyandu')->delete();

        $posyanduNames = [
            'Posyandu Mawar', 'Posyandu Melati', 'Posyandu Anggrek', 'Posyandu Kamboja',
            'Posyandu Flamboyan', 'Posyandu Teratai', 'Posyandu Cempaka', 'Posyandu Kenanga'
        ];

        $themes = [
            'Imunisasi Dasar', 'Pemeriksaan Balita', 'Pemeriksaan Ibu Hamil', 'Pemeriksaan Lansia',
            'Pemberian Vitamin A', 'Pemeriksaan Kesehatan Gigi', 'Konseling Gizi', 'Pemeriksaan Tumbuh Kembang'
        ];

        $jadwalData = [];

        for ($i = 0; $i < 100; $i++) {
            $date = Carbon::now()->addDays(rand(1, 365));

            $jadwalData[] = [
                'nama_posyandu' => $posyanduNames[array_rand($posyanduNames)],
                'tanggal' => $date->format('Y-m-d'),
                'tema' => $themes[array_rand($themes)],
                'keterangan' => 'Kegiatan posyandu rutin bulanan untuk ' . $themes[array_rand($themes)],
                // HAPUS BARIS INI: 'poster' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data dummy
        JadwalPosyandu::insert($jadwalData);

        // Tambahkan data spesifik seperti contoh
        JadwalPosyandu::create([
            'nama_posyandu' => 'Posyandu Mawar',
            'tanggal' => '2025-05-31',
            'tema' => 'Imunisasi balita',
            'keterangan' => 'kkkk',
            // HAPUS BARIS INI: 'poster' => null,
        ]);

        JadwalPosyandu::create([
            'nama_posyandu' => 'Posyandu Melati',
            'tanggal' => '2025-11-18',
            'tema' => 'Pemeriksaan USG',
            'keterangan' => 'hhjhh',
            // HAPUS BARIS INI: 'poster' => null,
        ]);
    }
}
