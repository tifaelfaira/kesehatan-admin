<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Halaman Dashboard Admin
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Halaman Jadwal Kesehatan
     */
    public function jadwal()
    {
        $jadwal = [
            [
                'tanggal' => '2025-10-05',
                'tema' => 'Pemeriksaan Balita & Imunisasi',
                'keterangan' => 'Cek berat badan, tinggi, dan imunisasi campak.'
            ],
            [
                'tanggal' => '2025-10-12',
                'tema' => 'Penyuluhan Gizi Ibu Hamil',
                'keterangan' => 'Materi gizi seimbang untuk ibu hamil.'
            ],
            [
                'tanggal' => '2025-10-19',
                'tema' => 'Pemeriksaan Lansia',
                'keterangan' => 'Pemeriksaan tekanan darah, gula darah, dan konseling.'
            ],
        ];

        return view('admin.jadwal', compact('jadwal'));
    }
}
