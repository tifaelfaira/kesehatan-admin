<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateFirstUserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua user existing
        DB::table('users')->delete();

        // Buat user admin - TAMBAH ROLE
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // TAMBAH INI
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat 100 user biasa menggunakan factory
        User::factory()->count(100)->create();

        $this->command->info('User admin dan 100 data user berhasil dibuat!');
        $this->command->info('Email admin: admin@example.com');
        $this->command->info('Password admin: password123');
        $this->command->info('Password user biasa: password');
        $this->command->info('Total user: ' . User::count());
    }
}