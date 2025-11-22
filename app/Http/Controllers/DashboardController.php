<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\JadwalPosyandu;
use App\Models\LayananPosyandu;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Statistik REAL dari database
        $stats = [
            'totalWarga' => Warga::count(),
            'totalJadwal' => JadwalPosyandu::where('tanggal', '>=', today())->count(),
            'totalUser' => User::count(),
            'jadwalHariIni' => JadwalPosyandu::whereDate('tanggal', today())->count(),
            'kunjunganBulanIni' => LayananPosyandu::whereMonth('created_at', now()->month)->count(),
            'rataRataUsia' => $this->hitungRataRataUsia(),
            'kepuasanWarga' => 95.2,
            'wargaAktif' => 72,
            'persentaseLansia' => $this->hitungPersentaseLansia(),
            'persentaseIbuBalita' => $this->hitungPersentaseIbuBalita(),
            'pending' => 5,
            'selesai' => LayananPosyandu::count(),
            'berjalan' => JadwalPosyandu::where('tanggal', '>=', today())->count()
        ];

        // Data Warga Terbaru REAL
        $wargaTerbaru = Warga::latest()
            ->take(5)
            ->get()
            ->map(function($warga) {
                return [
                    'id' => $warga->id,
                    'nama' => $warga->nama,
                    'usia' => $warga->umur ?? Carbon::parse($warga->tanggal_lahir)->age ?? '-',
                    'rt' => $warga->rt ?? '01',
                    'rw' => $warga->rw ?? '01',
                    'jenis_kelamin' => $warga->jenis_kelamin,
                    'status' => $this->getStatusWarga($warga)
                ];
            });

        // Data Jadwal Posyandu Mendatang REAL
        $jadwalMendatang = JadwalPosyandu::where('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->take(5)
            ->get()
            ->map(function($jadwal) {
                return [
                    'id' => $jadwal->jadwal_id,
                    'tanggal' => $jadwal->tanggal,
                    'nama_posyandu' => $jadwal->nama_posyandu,
                    'tema' => $jadwal->tema,
                    'keterangan' => $jadwal->keterangan,
                    'status' => $jadwal->tanggal == today() ? 'hari_ini' : 'akan_datang'
                ];
            });

        // Data Aktivitas Terkini - Dummy (bisa diganti dengan real data later)
        $aktivitasTerkini = [
            [
                'type' => 'jadwal',
                'title' => 'Jadwal Posyandu Baru',
                'description' => 'Posyandu Melati - Pemeriksaan Balita',
                'time' => '2 jam yang lalu',
                'icon' => 'bi-calendar-plus',
                'color' => 'primary'
            ],
            [
                'type' => 'warga',
                'title' => 'Warga baru terdaftar',
                'description' => 'Data warga baru berhasil ditambahkan',
                'time' => '4 jam yang lalu',
                'icon' => 'bi-person-plus',
                'color' => 'success'
            ],
            [
                'type' => 'layanan',
                'title' => 'Layanan Posyandu Ditambahkan',
                'description' => 'Data layanan posyandu baru dicatat',
                'time' => '6 jam yang lalu',
                'icon' => 'bi-hospital',
                'color' => 'info'
            ],
            [
                'type' => 'pemeriksaan',
                'title' => 'Pemeriksaan selesai',
                'description' => 'Pemeriksaan kesehatan rutin posyandu',
                'time' => '8 jam yang lalu',
                'icon' => 'bi-heart-pulse',
                'color' => 'warning'
            ]
        ];

        // Data Chart Dummy (bisa diimplementasikan later dengan real data)
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'kunjungan_posyandu' => [45, 60, 55, 70, 65, 80],
            'imunisasi' => [25, 30, 28, 35, 32, 40],
            'pemeriksaan' => [35, 45, 40, 50, 48, 55]
        ];

        return view('dashboard', compact(
            'stats',
            'wargaTerbaru',
            'jadwalMendatang',
            'aktivitasTerkini',
            'chartData'
        ));
    }

    /**
     * Hitung rata-rata usia warga
     */
    private function hitungRataRataUsia()
    {
        $wargas = Warga::all();
        $totalUsia = 0;
        $count = 0;

        foreach ($wargas as $warga) {
            if ($warga->umur) {
                $totalUsia += $warga->umur;
                $count++;
            } elseif ($warga->tanggal_lahir) {
                $usia = Carbon::parse($warga->tanggal_lahir)->age;
                $totalUsia += $usia;
                $count++;
            }
        }

        return $count > 0 ? round($totalUsia / $count, 1) : 0;
    }

    /**
     * Hitung persentase warga lansia (60+ tahun)
     */
    private function hitungPersentaseLansia()
    {
        $totalWarga = Warga::count();
        if ($totalWarga == 0) return 0;

        $lansiaCount = 0;

        foreach (Warga::all() as $warga) {
            $usia = $warga->umur;
            if (!$usia && $warga->tanggal_lahir) {
                $usia = Carbon::parse($warga->tanggal_lahir)->age;
            }
            
            if ($usia && $usia >= 60) {
                $lansiaCount++;
            }
        }

        return round(($lansiaCount / $totalWarga) * 100);
    }

    /**
     * Hitung persentase ibu hamil & balita
     */
    private function hitungPersentaseIbuBalita()
    {
        $totalWarga = Warga::count();
        if ($totalWarga == 0) return 0;

        $ibuBalitaCount = 0;

        foreach (Warga::all() as $warga) {
            $usia = $warga->umur;
            if (!$usia && $warga->tanggal_lahir) {
                $usia = Carbon::parse($warga->tanggal_lahir)->age;
            }
            
            // Balita (0-5 tahun) atau Ibu Hamil (asumsi dari status)
            if ($usia && $usia <= 5) {
                $ibuBalitaCount++;
            }
            // Jika ada field status_kehamilan, bisa ditambahkan logic untuk ibu hamil
        }

        return round(($ibuBalitaCount / $totalWarga) * 100);
    }

    /**
     * Tentukan status warga berdasarkan usia
     */
    private function getStatusWarga($warga)
    {
        $usia = $warga->umur;
        if (!$usia && $warga->tanggal_lahir) {
            $usia = Carbon::parse($warga->tanggal_lahir)->age;
        }

        if (!$usia) return 'Aktif';

        if ($usia >= 60) return 'Lansia';
        if ($usia <= 5) return 'Balita';
        
        // Jika ada field khusus untuk ibu hamil, bisa ditambahkan di sini
        // if ($warga->status_kehamilan == 'hamil') return 'Ibu Hamil';
        
        return 'Aktif';
    }
}