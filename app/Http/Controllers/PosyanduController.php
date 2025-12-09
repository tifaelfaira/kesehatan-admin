<?php
// app/Http/Controllers/PosyanduController.php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Media;
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

        $posyandu = Posyandu::with('media')
            ->filter($request, $filterableColumns)
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
            'foto.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'caption.*' => 'nullable|string|max:255',
        ]);

        // Simpan data posyandu
        $posyandu = Posyandu::create($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']));

        // Handle upload file (multiple)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // Simpan file ke storage
                    $path = $file->storeAs('public/media', $fileName);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'posyandu',
                        'ref_id' => $posyandu->posyandu_id,
                        'file_name' => $fileName,
                        'caption' => $request->caption[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posyandu $posyandu)
    {
        $posyandu->load('media');

        // Hitung prev dan next
        $prev = Posyandu::where('posyandu_id', '<', $posyandu->posyandu_id)
            ->latest('posyandu_id')
            ->first();

        $next = Posyandu::where('posyandu_id', '>', $posyandu->posyandu_id)
            ->oldest('posyandu_id')
            ->first();

        return view('pages.posyandu.show', compact('posyandu', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posyandu $posyandu)
    {
        $posyandu->load('media');
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
            'foto.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'caption.*' => 'nullable|string|max:255',
            'existing_captions.*' => 'nullable|string|max:255',
            'delete_media.*' => 'nullable',
        ]);

        // Update data posyandu
        $posyandu->update($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']));

        // Update caption media yang sudah ada
        if ($request->has('existing_captions')) {
            foreach ($request->existing_captions as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->where('ref_table', 'posyandu')
                    ->where('ref_id', $posyandu->posyandu_id)
                    ->update(['caption' => $caption]);
            }
        }

        // Hapus media yang dipilih
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::where('media_id', $mediaId)
                    ->where('ref_table', 'posyandu')
                    ->where('ref_id', $posyandu->posyandu_id)
                    ->first();

                if ($media) {
                    // Hapus file dari storage
                    Storage::delete('public/media/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        // Handle upload file baru (multiple)
        if ($request->hasFile('foto')) {
            $existingCount = $posyandu->media()->count();

            foreach ($request->file('foto') as $index => $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // Simpan file ke storage
                    $path = $file->storeAs('public/media', $fileName);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'posyandu',
                        'ref_id' => $posyandu->posyandu_id,
                        'file_name' => $fileName,
                        'caption' => $request->caption[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $existingCount + $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $posyandu)
    {
        // Hapus semua file media terkait
        foreach ($posyandu->media as $media) {
            Storage::delete('public/media/' . $media->file_name);
            $media->delete();
        }

        $posyandu->delete();

        return redirect()->route('admin.posyandu.index')
            ->with('success', 'Data posyandu berhasil dihapus.');
    }

    /**
     * Hapus file media tunggal
     */
    public function deleteMedia(Posyandu $posyandu, Media $media)
    {
        // Pastikan media milik posyandu ini
        if ($media->ref_table === 'posyandu' && $media->ref_id === $posyandu->posyandu_id) {
            Storage::delete('public/media/' . $media->file_name);
            $media->delete();

            return back()->with('success', 'File berhasil dihapus.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
