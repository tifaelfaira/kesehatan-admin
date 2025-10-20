<?php

namespace App\Http\Controllers;

use App\Models\Kesehatan; // ← ini penting!
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    public function index()
    {
        $data = Kesehatan::all();
        return view('kesehatan.index', compact('data'));
    }

    public function create()
    {
        return view('kesehatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'kontak' => 'required',
            'foto' => 'image|nullable|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        Kesehatan::create($data);

        return redirect()->route('kesehatan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil data berdasarkan ID
    $data = \App\Models\Kesehatan::find($id);

    // Kalau data tidak ditemukan
    if (!$data) {
        return redirect()->route('kesehatan.index')->with('error', 'Data tidak ditemukan!');
    }

    // Kirim ke view edit
    return view('kesehatan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $item = Kesehatan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'kontak' => 'required',
            'foto' => 'image|nullable|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $item->update($data);

        return redirect()->route('kesehatan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Kesehatan::findOrFail($id);
        $item->delete();

        return redirect()->route('kesehatan.index')->with('success', 'Data berhasil dihapus!');
    }
}
