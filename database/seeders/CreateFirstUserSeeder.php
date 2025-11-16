<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateFirstUserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        // Hapus dulu user admin jika sudah ada
        User::where('email', 'admindesa@gmail.com')->delete();

        // Membuat akun admin pertama sesuai permintaan tugas.
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admindesa@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
