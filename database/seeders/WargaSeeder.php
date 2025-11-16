<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('warga')->delete(); // GANTI 'wargas' MENJADI 'warga'

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
    }
}