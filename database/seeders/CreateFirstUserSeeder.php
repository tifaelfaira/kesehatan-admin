<?php
// database/seeders/CreateFirstUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data existing untuk fresh start
        User::truncate();

        $users = [];

        // Data user tetap (4 user utama)
        $fixedUsers = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@binadesa.com',
                'password' => Hash::make('Super123'),
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin Utama',
                'username' => 'admin',
                'email' => 'admin@binadesa.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Petugas Posyandu',
                'username' => 'petugas',
                'email' => 'petugas@binadesa.com',
                'password' => Hash::make('Petugas123'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@binadesa.com',
                'password' => Hash::make('Budi123'),
                'role' => 'petugas',
            ],
        ];

        // Tambahkan user tetap ke array
        foreach ($fixedUsers as $user) {
            $users[] = array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Data dummy untuk 96 user tambahan
        $roles = ['petugas', 'admin', 'super_admin'];
        $roleWeights = ['petugas' => 70, 'admin' => 20, 'super_admin' => 10]; // persentase

        $firstNames = [
            'Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hadi', 'Indra', 'Joko',
            'Kartika', 'Lina', 'Mulyadi', 'Nina', 'Oki', 'Putri', 'Rina', 'Sari', 'Tono', 'Umi',
            'Wawan', 'Yuli', 'Zainal', 'Andi', 'Bayu', 'Cici', 'Dian', 'Eka', 'Farhan', 'Gina',
            'Hendra', 'Ika', 'Joni', 'Kiki', 'Lia', 'Mega', 'Nanda', 'Opi', 'Puji', 'Qori',
            'Rizki', 'Siska', 'Tika', 'Ujang', 'Vina', 'Wati', 'Yoga', 'Zara', 'Asep', 'Bambang'
        ];

        $lastNames = [
            'Santoso', 'Wijaya', 'Kusuma', 'Pratama', 'Sari', 'Nugroho', 'Putra', 'Hadi', 'Kurniawan', 'Saputra',
            'Dewi', 'Lestari', 'Kusumawati', 'Purnama', 'Surya', 'Gunawan', 'Rahman', 'Maulana', 'Firmansyah', 'Ramadan',
            'Hidayat', 'Kurnia', 'Sari', 'Wulandari', 'Saputri', 'Pertiwi', 'Handayani', 'Mulyani', 'Utami', 'Anggraini',
            'Susanti', 'Wahyuni', 'Rahayu', 'Indriani', 'Puspitasari', 'Ningrum', 'Fitriani', 'Astuti', 'Kartika', 'Marlina',
            'Halim', 'Perdana', 'Kusnadi', 'Hartono', 'Sihombing', 'Sinaga', 'Siregar', 'Lubis', 'Nasution', 'Ginting'
        ];

        // Generate 96 user tambahan
        for ($i = 1; $i <= 96; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $name = $firstName . ' ' . $lastName;
            $username = strtolower($firstName . $i);
            $email = strtolower($firstName . $i . '@binadesa.com');
            
            // Tentukan role berdasarkan weight
            $role = $this->getRandomRole($roleWeights);
            
            $users[] = [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('Password123'), // Password default
                'role' => $role,
                'created_at' => now()->subDays(rand(0, 365)), // Random date dalam 1 tahun terakhir
                'updated_at' => now(),
            ];
        }

        // Insert semua data
        User::insert($users);

        // Tampilkan informasi
        $totalUsers = count($users);
        $superAdminCount = count(array_filter($users, fn($user) => $user['role'] === 'super_admin'));
        $adminCount = count(array_filter($users, fn($user) => $user['role'] === 'admin'));
        $petugasCount = count(array_filter($users, fn($user) => $user['role'] === 'petugas'));

        $this->command->info("Seeder berhasil dijalankan!");
        $this->command->info("Total user: {$totalUsers}");
        $this->command->info("Super Admin: {$superAdminCount}");
        $this->command->info("Admin: {$adminCount}");
        $this->command->info("Petugas: {$petugasCount}");
    }

    /**
     * Fungsi untuk mendapatkan role berdasarkan weight
     */
    private function getRandomRole(array $weights): string
    {
        $totalWeight = array_sum($weights);
        $random = rand(1, $totalWeight);
        $current = 0;
        
        foreach ($weights as $role => $weight) {
            $current += $weight;
            if ($random <= $current) {
                return $role;
            }
        }
        
        return 'petugas'; // fallback
    }
}