<?php
// database/seeders/CreateFirstUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// UBAH NAMA CLASS DI SINI:
class CreateFirstUserSeeder extends Seeder  // <-- DIUBAH
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@binadesa.com',
            'password' => Hash::make('Super123'),
            'role' => 'super_admin',
        ]);

        // Admin
        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'email' => 'admin@binadesa.com',
            'password' => Hash::make('Admin123'),
            'role' => 'admin',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas Posyandu',
            'username' => 'petugas',
            'email' => 'petugas@binadesa.com',
            'password' => Hash::make('Petugas123'),
            'role' => 'petugas',
        ]);

        // Petugas 2
        User::create([
            'name' => 'Budi Santoso',
            'username' => 'budi',
            'email' => 'budi@binadesa.com',
            'password' => Hash::make('Budi123'),
            'role' => 'petugas',
        ]);
    }
}
