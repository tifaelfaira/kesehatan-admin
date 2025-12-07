<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosyanduSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posyandu')->delete();

        $posyanduData = [];
        
        // Daftar nama posyandu
        $namaPosyandu = [
            'Posyandu Kenanga', 'Posyandu Cempaka', 'Posyandu Kamboja', 'Posyandu Anggrek',
            'Posyandu Flamboyan', 'Posyandu Melati', 'Posyandu Mawar', 'Posyandu Teratai',
            'Posyandu Dahlia', 'Posyandu Sakura', 'Posyandu Tulip', 'Posyandu Matahari',
            'Posyandu Bougenville', 'Posyandu Lavender', 'Posyandu Orchid', 'Posyandu Lily'
        ];
        
        $jalan = ['Jl. Merdeka', 'Jl. Sudirman', 'Jl. Gatot Subroto', 'Jl. Pahlawan', 'Jl. Ahmad Yani'];
        $kelurahan = ['Mekarjaya', 'Sukamaju', 'Cibeunying', 'Cikutra', 'Antapani'];
        $kecamatan = ['Bandung Kulon', 'Bandung Kidul', 'Bandung Wetan'];
        
        // RT dan RW terpisah
        $rtList = ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010'];
        $rwList = ['002', '003', '004', '005', '006', '007', '008', '009', '010', '011'];
        
        for ($i = 1; $i <= 100; $i++) {
            // Untuk 10 data pertama, gunakan nama yang sama dengan gambar
            if ($i <= 10) {
                $nama = [
                    'Posyandu Kenanga', 'Posyandu Cempaka', 'Posyandu Kamboja', 'Posyandu Anggrek',
                    'Posyandu Flamboyan', 'Posyandu Melati', 'Posyandu Anggrek', 'Posyandu Anggrek',
                    'Posyandu Melati', 'Posyandu Anggrek'
                ][$i-1];
            } else {
                $nama = $namaPosyandu[array_rand($namaPosyandu)] . ' ' . $i;
            }
            
            $rt = $rtList[array_rand($rtList)];
            $rw = $rwList[array_rand($rwList)];
            
            $posyanduData[] = [
                'nama' => $nama, // KOLOM YANG BENAR: 'nama' (bukan 'name')
                'alamat' => $jalan[array_rand($jalan)] . ' No. ' . rand(1, 100) . 
                           ', Kel. ' . $kelurahan[array_rand($kelurahan)] . 
                           ', Kec. ' . $kecamatan[array_rand($kecamatan)],
                'rt' => $rt,
                'rw' => $rw,
                'kontak' => '08' . rand(11, 99) . rand(10000000, 99999999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('posyandu')->insert($posyanduData);
        
        $this->command->info('Seeder Posyandu berhasil! 100 data ditambahkan.');
    }
}