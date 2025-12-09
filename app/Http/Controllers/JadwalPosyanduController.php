<?php
// app/Http/Controllers/JadwalPosyanduController.php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['nama_posyandu', 'tema'];
        $searchableColumns = ['nama_posyandu', 'tema', 'keterangan'];

        $jadwal = JadwalPosyandu::with('media')
            ->latest()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        // Data untuk dropdown filter
        $namaPosyanduList = JadwalPosyandu::distinct()->pluck('nama_posyandu');
        $temaList = JadwalPosyandu::distinct()->pluck('tema');

        return view('pages.jadwal_posyandu.index', compact('jadwal', 'namaPosyanduList', 'temaList'));
    }

    public function show($jadwal_id)
    {
        $jadwal = JadwalPosyandu::with('media')->findOrFail($jadwal_id);

        // Hitung prev dan next di controller
        $prev = JadwalPosyandu::where('jadwal_id', '<', $jadwal->jadwal_id)
            ->latest('jadwal_id')
            ->first();

        $next = JadwalPosyandu::where('jadwal_id', '>', $jadwal->jadwal_id)
            ->oldest('jadwal_id')
            ->first();

        return view('pages.jadwal_posyandu.show', compact('jadwal', 'prev', 'next'));
    }

    public function create()
    {
        return view('pages.jadwal_posyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'captions.*' => 'nullable|string|max:255',
        ]);

        // Simpan data jadwal
        $jadwal = JadwalPosyandu::create($request->only(['nama_posyandu', 'tanggal', 'tema', 'keterangan']));

        // Handle upload file (multiple)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // Simpan file ke storage
                    $path = $file->storeAs('public/media', $fileName);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'jadwal_posyandu',
                        'ref_id' => $jadwal->jadwal_id,
                        'file_name' => $fileName,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($jadwal_id)
    {
        $jadwal = JadwalPosyandu::with('media')->findOrFail($jadwal_id);
        return view('pages.jadwal_posyandu.edit', compact('jadwal'));
    }

    public function update(Request $request, $jadwal_id)
    {
        $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:200',
            'keterangan' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'captions.*' => 'nullable|string|max:255',
            'existing_captions.*' => 'nullable|string|max:255',
            'delete_media.*' => 'nullable',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($jadwal_id);
        $jadwal->update($request->only(['nama_posyandu', 'tanggal', 'tema', 'keterangan']));

        // Update caption media yang sudah ada
        if ($request->has('existing_captions')) {
            foreach ($request->existing_captions as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->where('ref_table', 'jadwal_posyandu')
                    ->where('ref_id', $jadwal->jadwal_id)
                    ->update(['caption' => $caption]);
            }
        }

        // Hapus media yang dipilih
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::where('media_id', $mediaId)
                    ->where('ref_table', 'jadwal_posyandu')
                    ->where('ref_id', $jadwal->jadwal_id)
                    ->first();

                if ($media) {
                    // Hapus file dari storage
                    Storage::delete('public/media/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        // Handle upload file baru (multiple)
        if ($request->hasFile('files')) {
            $existingCount = $jadwal->media()->count();

            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // Simpan file ke storage
                    $path = $file->storeAs('public/media', $fileName);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'jadwal_posyandu',
                        'ref_id' => $jadwal->jadwal_id,
                        'file_name' => $fileName,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $existingCount + $index,
                    ]);
                }
            }
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($jadwal_id)
    {
        $jadwal = JadwalPosyandu::with('media')->findOrFail($jadwal_id);

        // Hapus semua file media terkait
        foreach ($jadwal->media as $media) {
            Storage::delete('public/media/' . $media->file_name);
            $media->delete();
        }

        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Hapus file media tunggal
     */
    public function deleteMedia($jadwal_id, Media $media)
    {
        $jadwal = JadwalPosyandu::findOrFail($jadwal_id);

        // Pastikan media milik jadwal posyandu ini
        if ($media->ref_table === 'jadwal_posyandu' && $media->ref_id === $jadwal->jadwal_id) {
            Storage::delete('public/media/' . $media->file_name);
            $media->delete();

            return back()->with('success', 'File berhasil dihapus.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
