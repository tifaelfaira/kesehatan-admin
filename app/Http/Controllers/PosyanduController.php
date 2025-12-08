<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['nama', 'alamat'];
        $searchableColumns = ['nama', 'alamat', 'rt', 'rw', 'kontak'];
        
        $posyandu = Posyandu::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
            
        return view('pages.posyandu.index', compact('posyandu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.posyandu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kontak' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('posyandu', 'public');
            $data['foto'] = $path;
        }

        Posyandu::create($data);

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posyandu $posyandu)
    {
        return view('pages.posyandu.show', compact('posyandu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posyandu $posyandu)
    {
        return view('pages.posyandu.edit', compact('posyandu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posyandu $posyandu)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kontak' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($posyandu->foto && Storage::disk('public')->exists($posyandu->foto)) {
                Storage::disk('public')->delete($posyandu->foto);
            }
            
            $path = $request->file('foto')->store('posyandu', 'public');
            $data['foto'] = $path;
        }

        $posyandu->update($data);

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $posyandu)
    {
        // Hapus foto jika ada
        if ($posyandu->foto && Storage::disk('public')->exists($posyandu->foto)) {
            Storage::disk('public')->delete($posyandu->foto);
        }

        $posyandu->delete();

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil dihapus.');
    }
}