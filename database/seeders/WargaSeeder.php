<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('warga')->delete();

        // Pertama, buat 3 data spesifik seperti yang Anda inginkan
        Warga::create([
            'nama' => 'Dita Karang',
            'nik' => '1234567890123455',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 1,
            'pekerjaan' => 'Anak-anak',
            'rt_rw' => '001/001',
            'alamat' => 'Jl. Delima'
        ]);

        Warga::create([
            'nama' => 'Ayy',
            'nik' => '1234567890123456',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 2,
            'pekerjaan' => 'Anak-anak',
            'rt_rw' => '001/002',
            'alamat' => 'Jl. Mawar'
        ]);

        Warga::create([
            'nama' => 'Acha',
            'nik' => '1234567890123457',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 3,
            'pekerjaan' => 'Anak-anak',
            'rt_rw' => '001/002',
            'alamat' => 'Jl. Melati'
        ]);

        // Tambahkan 97 data dummy lainnya
        $firstNames = ['Ahmad', 'Siti', 'Budi', 'Dewi', 'Joko', 'Rini', 'Agus', 'Maya', 'Rudi', 'Sari', 'Hendra', 'Linda'];
        $lastNames = ['Santoso', 'Rahayu', 'Prasetyo', 'Wulandari', 'Susilo', 'Haryanti', 'Wijaya', 'Lestari', 'Kurniawan', 'Pertiwi', 'Gunawan', 'Suryani'];
        
        $wargaData = [];

        for ($i = 4; $i <= 100; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $jenisKelamin = rand(0, 1) ? 'Laki-laki' : 'Perempuan';
            
            // Pastikan ada variasi usia untuk demografi
            $umur = rand(1, 80);
            $pekerjaan = $this->getPekerjaanByUmur($umur);
            $rt = str_pad(rand(1, 5), 3, '0', STR_PAD_LEFT);
            $rw = str_pad(rand(1, 3), 3, '0', STR_PAD_LEFT);

            $wargaData[] = [
                'nama' => $firstName . ' ' . $lastName,
                'nik' => '1234567890123' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'jenis_kelamin' => $jenisKelamin,
                'umur' => $umur,
                'pekerjaan' => $pekerjaan,
                'rt_rw' => $rt . '/' . $rw,
                'alamat' => 'Jl. ' . $lastNames[array_rand($lastNames)] . ' No.' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert setiap 20 data untuk menghindari memory limit
            if (($i - 3) % 20 === 0) {
                Warga::insert($wargaData);
                $wargaData = [];
            }
        }

        // Insert sisa data
        if (!empty($wargaData)) {
            Warga::insert($wargaData);
        }

        $this->command->info('Seeder Warga berhasil dengan 100 data!');
    }

    private function getPekerjaanByUmur($umur)
    {
        if ($umur <= 5) return 'Anak-anak';
        if ($umur <= 17) return 'Pelajar';
        if ($umur <= 25) return 'Mahasiswa';
        if ($umur <= 60) {
            $pekerjaan = ['Wiraswasta', 'PNS', 'Karyawan Swasta', 'Petani', 'Nelayan', 'Guru', 'Perawat'];
            return $pekerjaan[array_rand($pekerjaan)];
        }
        return 'Pensiunan';
    }
}