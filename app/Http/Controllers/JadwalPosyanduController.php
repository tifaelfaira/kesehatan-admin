<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    public function index()
    {
        // UBAH INI: dari get() menjadi paginate(10)
        $jadwal = JadwalPosyandu::latest()->paginate(10);
        return view('pages.jadwal_posyandu.index', compact('jadwal'));
    }

    public function create()
    {
        return view('pages.jadwal_posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|string',
        ]);

        JadwalPosyandu::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($jadwal_id)
    {
        $jadwal = JadwalPosyandu::findOrFail($jadwal_id);
        return view('pages.jadwal_posyandu.edit', compact('jadwal'));
    }

    public function update(Request $request, $jadwal_id)
    {
        $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|string',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($jadwal_id);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($jadwal_id)
    {
        $jadwal = JadwalPosyandu::findOrFail($jadwal_id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}