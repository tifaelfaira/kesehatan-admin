<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KaderPosyandu;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class KaderPosyanduController extends Controller
{
    public function index()
    {
        $kader = KaderPosyandu::with(['posyandu', 'warga'])->paginate(10);
        return view('pages.kader_posyandu.index', compact('kader'));
    }

    public function create()
    {
        $posyandu = Posyandu::orderBy('nama')->get();
        $warga    = Warga::orderBy('nama')->get();
        return view('pages.kader_posyandu.create', compact('posyandu', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'warga_id'    => 'required|exists:warga,warga_id',
            'peran'       => 'required|string|max:100',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date|after_or_equal:mulai_tugas',
        ]);

        KaderPosyandu::create($request->all());

        return redirect()->route('admin.kader-posyandu.index')
            ->with('success', 'Data kader posyandu berhasil ditambahkan');
    }

    public function edit(KaderPosyandu $kader_posyandu)
    {
        $kader = $kader_posyandu; // alias

        $posyandu = Posyandu::orderBy('nama')->get();
        $warga    = Warga::orderBy('nama')->get();

        return view(
            'pages.kader_posyandu.edit',
            compact('kader', 'posyandu', 'warga')
        );
    }

    public function update(Request $request, KaderPosyandu $kader_posyandu)
    {
        $kader = $kader_posyandu;

        $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'warga_id'    => 'required|exists:warga,id', // ✅ FIX
            'peran'       => 'required|string|max:100',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date|after_or_equal:mulai_tugas',
        ]);

        $kader->update($request->all());

        return redirect()
            ->route('admin.kader-posyandu.index')
            ->with('success', 'Data kader posyandu berhasil diperbarui');
    }

    public function destroy(KaderPosyandu $kader_posyandu)
    {
        $kader_posyandu->delete();

        return redirect()->route('admin.kader-posyandu.index')
            ->with('success', 'Data kader posyandu berhasil dihapus');
    }
}
