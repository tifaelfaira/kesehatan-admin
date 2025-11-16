<?php

namespace App\Http\Controllers;

use App\Models\LayananPosyandu;
use App\Models\JadwalKesehatan;
use App\Models\Warga;
use Illuminate\Http\Request;

class LayananPosyanduController extends Controller
{
    // Menampilkan daftar layanan posyandu
    public function index()
    {
        $data = LayananPosyandu::with(['jadwal', 'warga'])
            ->orderBy('layanan_id', 'DESC')
            ->paginate(10);

        return view('pages.layanan_posyandu.index', compact('data'));
    }

    // Form tambah layanan
    public function create()
    {
        $jadwal = JadwalKesehatan::orderBy('tanggal', 'asc')->get();
        $warga  = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan_posyandu.create', compact('jadwal', 'warga'));
    }

    // Simpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_kesehatans,id',
            'warga_id' => 'required|exists:warga,id',
            'berat' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
            'vitamin' => 'nullable|string',
            'konseling' => 'nullable|string',
        ]);

        LayananPosyandu::create($request->only([
            'jadwal_id',
            'warga_id',
            'berat',
            'tinggi',
            'vitamin',
            'konseling',
        ]));

        return redirect()->route('admin.layanan-posyandu.index')
            ->with('success', 'Data layanan berhasil ditambahkan!');
    }

    // Form edit layanan
    public function edit($layanan_id)
    {
        $layanan = LayananPosyandu::findOrFail($layanan_id);
        $jadwal = JadwalKesehatan::orderBy('tanggal', 'asc')->get();
        $warga  = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan_posyandu.edit', compact('layanan', 'jadwal', 'warga'));
    }

    // Update layanan
    public function update(Request $request, $layanan_id)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_kesehatans,id',
            'warga_id' => 'required|exists:warga,id',
            'berat' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
            'vitamin' => 'nullable|string',
            'konseling' => 'nullable|string',
        ]);

        $layanan = LayananPosyandu::findOrFail($layanan_id);
        $layanan->update($request->only([
            'jadwal_id',
            'warga_id',
            'berat',
            'tinggi',
            'vitamin',
            'konseling',
        ]));

        return redirect()->route('admin.layanan-posyandu.index')
            ->with('success', 'Data layanan berhasil diperbarui!');
    }

    // Hapus layanan
    public function destroy($layanan_id)
    {
        $layanan = LayananPosyandu::findOrFail($layanan_id);
        $layanan->delete();

        return redirect()->route('admin.layanan-posyandu.index')
            ->with('success', 'Data layanan berhasil dihapus!');
    }
}
