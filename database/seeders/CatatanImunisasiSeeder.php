<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatatanImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama jika ada
        DB::table('catatan_imunisasi')->delete();

        // Cek apakah ada data warga
        $wargaCount = DB::table('warga')->count();
        if ($wargaCount == 0) {
            $this->command->error('Tabel warga kosong! Jalankan WargaSeeder dulu.');
            return;
        }

        // Ambil semua warga
        $warga = DB::table('warga')->get()->toArray();
        
        // Data jenis vaksin
        $jenisVaksin = [
            'Polio', 'DPT', 'Hepatitis B', 'BCG', 'Campak', 'Rubella', 
            'Influenza', 'Covid-19', 'HPV', 'Tetanus', 'Rotavirus', 'Pneumokokus',
            'MMR', 'Varicella', 'Hepatitis A', 'Typhoid', 'Meningitis'
        ];
        
        // Data lokasi
        $lokasi = [
            'Posyandu Mawar', 'Posyandu Melati', 'Posyandu Anggrek', 'Posyandu Kamboja',
            'Posyandu Flamboyan', 'Posyandu Teratai', 'Posyandu Cempaka', 'Posyandu Kenanga',
            'Puskesmas Desa', 'Rumah Sakit Umum', 'Klinik Pratama', 'Balai Desa'
        ];
        
        // Data nakes (tenaga kesehatan)
        $nakes = [
            'dr. Alina', 'dr. Budi', 'dr. Citra', 'dr. Darma', 'dr. Eka', 'dr. Fajar',
            'dr. Gita', 'dr. Hadi', 'dr. Indah', 'dr. Joko', 'Alra', 'Dr. Tess Fay',
            'dr. Roujwa', 'dr. Tifosifira'
        ];

        $catatanData = [];
        
        // Buat 100 data catatan imunisasi
        for ($i = 1; $i <= 100; $i++) {
            // Ambil warga secara acak
            $wargaRandom = $warga[array_rand($warga)];
            
            // Buat tanggal acak dalam 2 tahun terakhir
            $tanggal = date('Y-m-d', strtotime('-' . rand(1, 730) . ' days'));
            
            $catatanData[] = [
                'warga_id' => $wargaRandom->id,
                'jenis_vaksin' => $jenisVaksin[array_rand($jenisVaksin)],
                'tanggal' => $tanggal,
                'lokasi' => $lokasi[array_rand($lokasi)],
                'nakes' => $nakes[array_rand($nakes)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Tambahkan data spesifik dari gambar (Agus Pertiwi)
        // Cari warga bernama Agus Pertiwi atau buat jika tidak ada
        $wargaAgus = DB::table('warga')
            ->where('nama', 'like', '%Agus%')
            ->orWhere('nama', 'like', '%Pertiwi%')
            ->first();
            
        if ($wargaAgus) {
            $catatanData[0] = [ // Ganti data pertama
                'warga_id' => $wargaAgus->id,
                'jenis_vaksin' => 'Polio',
                'tanggal' => '2025-12-07',
                'lokasi' => 'Posyandu Melati',
                'nakes' => 'Alra',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert ke database
        DB::table('catatan_imunisasi')->insert($catatanData);
        
        $this->command->info('Seeder Catatan Imunisasi berhasil! 100 data ditambahkan.');
    }
}