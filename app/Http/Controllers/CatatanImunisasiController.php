<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use Illuminate\Http\Request;

class CatatanImunisasiController extends Controller
{
    public function index()
    {
        // TAMBAHKAN PAGINATE dengan onEachSide(2)
        $catatan = CatatanImunisasi::with('warga')
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->onEachSide(2); // Menampilkan 2 halaman sebelum dan sesudah
        
        return view('pages.catatan_imunisasi.index', compact('catatan'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('pages.catatan_imunisasi.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'jenis_vaksin' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:100',
            'nakes' => 'nullable|string|max:100',
        ]);

        CatatanImunisasi::create([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
        ]);

        return redirect()->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $catatanImunisasi = CatatanImunisasi::with('warga')->findOrFail($id);
        return view('pages.catatan_imunisasi.show', compact('catatanImunisasi'));
    }

    public function edit($id)
    {
        $catatanImunisasi = CatatanImunisasi::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('pages.catatan_imunisasi.edit', compact('catatanImunisasi', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $catatanImunisasi = CatatanImunisasi::findOrFail($id);

        $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'jenis_vaksin' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:100',
            'nakes' => 'nullable|string|max:100',
        ]);

        $catatanImunisasi->update([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
        ]);

        return redirect()->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $catatanImunisasi = CatatanImunisasi::findOrFail($id);
        $catatanImunisasi->delete();

        return redirect()->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil dihapus.');
    }
}