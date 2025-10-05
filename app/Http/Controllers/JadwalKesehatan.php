<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalKesehatan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
