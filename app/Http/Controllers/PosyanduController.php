<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TAMBAHKAN PAGINATE
        $posyandu = Posyandu::orderBy('nama')->paginate(10);
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
        ]);

        Posyandu::create($request->all());

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
        ]);

        $posyandu->update($request->all());

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $posyandu)
    {
        $posyandu->delete();

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil dihapus.');
    }
}