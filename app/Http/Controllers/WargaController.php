<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // Tampilkan semua warga
    public function index()
    {
        // UBAH INI: dari all() menjadi paginate(10)
        $warga = Warga::orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.warga.index', compact('warga'));
    }

    // Form tambah warga
    public function create()
    {
        return view('pages.warga.create');
    }

    // Simpan warga baru
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

    // Form edit warga
    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    // Update warga
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

    // Hapus warga
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    // Tampilkan detail warga (jika diperlukan)
    public function show(Warga $warga)
    {
        return view('pages.warga.show', compact('warga'));
    }
}