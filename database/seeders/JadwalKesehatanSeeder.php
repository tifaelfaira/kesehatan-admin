<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalKesehatan;
use Illuminate\Support\Facades\DB;

class JadwalKesehatanSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama tanpa truncate supaya aman dengan FK
        DB::table('jadwal_kesehatans')->delete();

        // Tambahkan data dummy SESUAI SCREENSHOT
        JadwalKesehatan::create([
            'tanggal' => '2025-05-31',
            'nama_kegiatan' => 'Imunisasi balita', // GANTI 'kegiatan' menjadi 'nama_kegiatan'
            'keterangan' => 'kkkk',
            'lokasi' => 'jl.delima'
        ]);

        JadwalKesehatan::create([
            'tanggal' => '2025-11-18',
            'nama_kegiatan' => 'Pemeriksaan USG', // GANTI 'kegiatan' menjadi 'nama_kegiatan'
            'keterangan' => 'hhjhh',
            'lokasi' => 'jl.rowosari'
        ]);

        JadwalKesehatan::create([
            'tanggal' => '2025-11-20',
            'nama_kegiatan' => 'Posyandu Balita', // GANTI 'kegiatan' menjadi 'nama_kegiatan'
            'keterangan' => 'Balita 0-5 th',
            'lokasi' => 'Posyandu Mawar'
        ]);

        JadwalKesehatan::create([
            'tanggal' => '2025-11-22',
            'nama_kegiatan' => 'Posyandu Lansia', // GANTI 'kegiatan' menjadi 'nama_kegiatan'
            'keterangan' => 'Usia 60+',
            'lokasi' => 'Posyandu Melati'
        ]);
    }
}