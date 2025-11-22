<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['nama_posyandu', 'tema'];
        // TAMBAH INI: Kolom yang bisa dicari
        $searchableColumns = ['nama_posyandu', 'tema', 'keterangan'];

        // UBAH INI: Tambahkan search()
        $jadwal = JadwalPosyandu::latest()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns) // TAMBAH INI
            ->paginate(10)
            ->withQueryString();

        // Data untuk dropdown filter
        $namaPosyanduList = JadwalPosyandu::distinct()->pluck('nama_posyandu');
        $temaList = JadwalPosyandu::distinct()->pluck('tema');

        return view('pages.jadwal_posyandu.index', compact('jadwal', 'namaPosyanduList', 'temaList'));
    }

    // Method lainnya tetap sama...
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