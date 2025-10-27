<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\JadwalKesehatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();
        $totalJadwal = JadwalKesehatan::count();

        $wargaTerbaru = Warga::latest()->take(5)->get();
        $jadwalTerbaru = JadwalKesehatan::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalWarga', 'totalJadwal', 'wargaTerbaru', 'jadwalTerbaru'));
    }
}
