<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Statistik Dummy
        $stats = [
            'totalWarga' => 1.247,
            'totalJadwal' => 28,
            'totalUser' => 15,
            'jadwalHariIni' => 3,
            'kunjunganBulanIni' => 342,
            'rataRataUsia' => 45.6,
            'kepuasanWarga' => 92.5
        ];

        // Data Warga Terbaru Dummy
        $wargaTerbaru = [
            [
                'id' => 1,
                'nama' => 'Ahmad Santoso',
                'usia' => 35,
                'rt' => '01',
                'rw' => '03',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif'
            ],
            [
                'id' => 2,
                'nama' => 'Siti Rahayu',
                'usia' => 28,
                'rt' => '02',
                'rw' => '03',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif'
            ],
            [
                'id' => 3,
                'nama' => 'Budi Prasetyo',
                'usia' => 67,
                'rt' => '01',
                'rw' => '02',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Lansia'
            ],
            [
                'id' => 4,
                'nama' => 'Maya Sari',
                'usia' => 25,
                'rt' => '03',
                'rw' => '01',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Ibu Hamil'
            ],
            [
                'id' => 5,
                'nama' => 'Rizki Abdullah',
                'usia' => 42,
                'rt' => '02',
                'rw' => '02',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif'
            ]
        ];

        // Data Jadwal Mendatang Dummy
        $jadwalMendatang = [
            [
                'id' => 1,
                'tanggal' => now()->addDays(1)->format('Y-m-d'),
                'nama_kegiatan' => 'Pemeriksaan Balita & Imunisasi',
                'lokasi' => 'Posyandu Melati',
                'waktu' => '08:00 - 12:00',
                'peserta' => 'Balita 0-5 tahun',
                'status' => 'akan_datang'
            ],
            [
                'id' => 2,
                'tanggal' => now()->addDays(2)->format('Y-m-d'),
                'nama_kegiatan' => 'Penyuluhan Gizi Ibu Hamil',
                'lokasi' => 'Aula Desa',
                'waktu' => '09:00 - 11:00',
                'peserta' => 'Ibu Hamil',
                'status' => 'akan_datang'
            ],
            [
                'id' => 3,
                'tanggal' => now()->format('Y-m-d'),
                'nama_kegiatan' => 'Pemeriksaan Lansia',
                'lokasi' => 'Puskesmas Pembantu',
                'waktu' => '13:00 - 16:00',
                'peserta' => 'Lansia 60+',
                'status' => 'hari_ini'
            ],
            [
                'id' => 4,
                'tanggal' => now()->addDays(5)->format('Y-m-d'),
                'nama_kegiatan' => 'Vaksinasi COVID-19 Booster',
                'lokasi' => 'Balai Desa',
                'waktu' => '08:00 - 14:00',
                'peserta' => 'Warga 18+',
                'status' => 'akan_datang'
            ],
            [
                'id' => 5,
                'tanggal' => now()->addDays(7)->format('Y-m-d'),
                'nama_kegiatan' => 'Senam Sehat Lansia',
                'lokasi' => 'Lapangan Desa',
                'waktu' => '06:30 - 07:30',
                'peserta' => 'Lansia',
                'status' => 'akan_datang'
            ]
        ];

        // Data Aktivitas Terkini Dummy
        $aktivitasTerkini = [
            [
                'type' => 'jadwal',
                'title' => 'Jadwal baru ditambahkan',
                'description' => 'Pemeriksaan kesehatan gigi anak',
                'time' => '2 jam yang lalu',
                'icon' => 'bi-calendar-plus',
                'color' => 'primary'
            ],
            [
                'type' => 'warga',
                'title' => 'Warga baru terdaftar',
                'description' => 'Sari Dewi (RT 04/RW 02)',
                'time' => '4 jam yang lalu',
                'icon' => 'bi-person-plus',
                'color' => 'success'
            ],
            [
                'type' => 'laporan',
                'title' => 'Laporan kesehatan diterima',
                'description' => 'Laporan bulanan Posyandu',
                'time' => '6 jam yang lalu',
                'icon' => 'bi-file-earmark-medical',
                'color' => 'info'
            ],
            [
                'type' => 'pemeriksaan',
                'title' => 'Pemeriksaan selesai',
                'description' => 'Pemeriksaan tekanan darah rutin',
                'time' => '8 jam yang lalu',
                'icon' => 'bi-heart-pulse',
                'color' => 'warning'
            ]
        ];

        // Data Chart Dummy (untuk grafik)
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'kunjungan' => [120, 150, 180, 200, 240, 220],
            'imunisasi' => [45, 60, 55, 70, 65, 80],
            'pemeriksaan' => [75, 85, 90, 110, 105, 120]
        ];

        return view('dashboard', compact(
            'stats',
            'wargaTerbaru',
            'jadwalMendatang',
            'aktivitasTerkini',
            'chartData'
        ));
    }
}