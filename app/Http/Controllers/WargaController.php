<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // Tampilkan semua warga
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['jenis_kelamin', 'pekerjaan'];
        // TAMBAH INI: Kolom yang bisa dicari
        $searchableColumns = ['nama', 'nik', 'alamat', 'pekerjaan'];

        // UBAH INI: Tambahkan search()
        $warga = Warga::orderBy('created_at', 'DESC')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns) // TAMBAH INI
            ->paginate(10)
            ->withQueryString();

        // Data untuk dropdown filter
        $pekerjaanList = Warga::whereNotNull('pekerjaan')
            ->distinct()
            ->pluck('pekerjaan');

        return view('pages.warga.index', compact('warga', 'pekerjaanList'));
    }

    // Method lainnya tetap sama...
    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:warga',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|integer',
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'rt_rw' => 'nullable|string|max:50',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:warga,nik,' . $warga->id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|integer',
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'rt_rw' => 'nullable|string|max:50',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    public function show(Warga $warga)
    {
        return view('pages.warga.show', compact('warga'));
    }
}