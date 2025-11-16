<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananPosyandu;
use App\Models\JadwalKesehatan;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class LayananPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama - GUNAKAN 'layanan_posyandu' bukan 'layanan_posyandus'
        DB::table('layanan_posyandu')->delete();

        // Ambil jadwal & warga dari DB
        $imunisasiBalita = JadwalKesehatan::where('nama_kegiatan', 'Imunisasi balita')->first();
        $posyanduBalita = JadwalKesehatan::where('nama_kegiatan', 'Posyandu Balita')->first();

        $wargaDita = Warga::where('nama', 'Dita Karang')->first();
        $wargaAyy = Warga::where('nama', 'Ayy')->first();
        $wargaAcha = Warga::where('nama', 'Acha')->first();

        // Pastikan data ada
        if ($imunisasiBalita && $posyanduBalita && $wargaDita && $wargaAyy && $wargaAcha) {

            LayananPosyandu::create([
                'jadwal_id' => $imunisasiBalita->id,
                'warga_id' => $wargaDita->id,
                'berat' => 1,
                'tinggi' => 10,
                'vitamin' => 'Vitamin D',
                'konseling' => 'Kurang Asupan Farid',
            ]);

            LayananPosyandu::create([
                'jadwal_id' => $posyanduBalita->id,
                'warga_id' => $wargaAyy->id,
                'berat' => 12,
                'tinggi' => 85,
                'vitamin' => 'Vitamin C',
                'konseling' => 'Nutrisi Tambahan',
            ]);

            LayananPosyandu::create([
                'jadwal_id' => $posyanduBalita->id,
                'warga_id' => $wargaAcha->id,
                'berat' => 12,
                'tinggi' => 85,
                'vitamin' => 'Vitamin C',
                'konseling' => 'Nutrisi Tambahan',
            ]);
        }
    }
}