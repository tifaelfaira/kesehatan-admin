<?php

namespace App\Http\Controllers;

use App\Models\JadwalKesehatan;
use Illuminate\Http\Request;

class JadwalKesehatanController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKesehatan::latest()->get();
        return view('pages.jadwal_kesehatan.index', compact('jadwal'));
    }

    public function create()
    {
        return view('pages.jadwal_kesehatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        JadwalKesehatan::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalKesehatan $jadwal)
    {
        return view('pages.jadwal_kesehatan.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalKesehatan $jadwal)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalKesehatan $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
