<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class ModulAController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('admin.modul-a', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.modul-a-create');
    }

    public function store(Request $request)
    {
        Kegiatan::create($request->all());
        return redirect()->route('modulA.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.modul-a-edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());
        return redirect()->route('modulA.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Kegiatan::destroy($id);
        return redirect()->route('modulA.index')->with('success', 'Data berhasil dihapus.');
    }
}
