<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Multipleuploads;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $pelanggan = Pelanggan::when($search, function($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('pages.pelanggan.index', compact('pelanggan', 'search'));
    }

    public function create()
    {
        return view('pages.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email|unique:pelanggan,email',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $files = $pelanggan->files;
        
        return view('pages.pelanggan.show', compact('pelanggan', 'files'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pages.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email|unique:pelanggan,email,' . $id,
            'telepon' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}