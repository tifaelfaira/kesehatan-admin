<?php
// app/Http/Controllers/CatatanImunisasiController.php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $jenisVaksinList = CatatanImunisasi::distinct()
            ->orderBy('jenis_vaksin')
            ->pluck('jenis_vaksin');

        $filterableColumns = ['jenis_vaksin', 'nama_warga', 'tanggal_dari', 'tanggal_sampai'];
        $searchableColumns = ['jenis_vaksin', 'lokasi', 'nakes', 'nama_warga'];

        $catatan = CatatanImunisasi::with(['warga', 'media'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view(
            'pages.catatan_imunisasi.index',
            compact('catatan', 'jenisVaksinList')
        );
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('pages.catatan_imunisasi.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'     => 'required|exists:warga,id',
            'jenis_vaksin' => 'required|string|max:100',
            'tanggal'      => 'required|date',
            'lokasi'       => 'nullable|string|max:100',
            'nakes'        => 'nullable|string|max:100',
            'files.*'      => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'captions.*'   => 'nullable|string|max:255',
        ]);

        $catatan = CatatanImunisasi::create([
            'warga_id'     => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal'      => $request->tanggal,
            'lokasi'       => $request->lokasi,
            'nakes'        => $request->nakes,
        ]);

        // Upload media ke DISK PUBLIC (FIX)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {

                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    Storage::disk('public')->putFileAs(
                        'media',
                        $file,
                        $fileName
                    );

                    Media::create([
                        'ref_table' => 'catatan_imunisasi',
                        'ref_id'    => $catatan->imunisasi_id,
                        'file_name' => $fileName,
                        'caption'   => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order'=> $index,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $catatanImunisasi = CatatanImunisasi::with(['warga', 'media'])->findOrFail($id);

        $prev = CatatanImunisasi::where('imunisasi_id', '<', $catatanImunisasi->imunisasi_id)
            ->latest('imunisasi_id')
            ->first();

        $next = CatatanImunisasi::where('imunisasi_id', '>', $catatanImunisasi->imunisasi_id)
            ->oldest('imunisasi_id')
            ->first();

        return view(
            'pages.catatan_imunisasi.show',
            compact('catatanImunisasi', 'prev', 'next')
        );
    }

    public function edit($id)
    {
        $catatanImunisasi = CatatanImunisasi::with('media')->findOrFail($id);
        $warga = Warga::orderBy('nama')->get();

        return view(
            'pages.catatan_imunisasi.edit',
            compact('catatanImunisasi', 'warga')
        );
    }

    public function update(Request $request, $id)
    {
        $catatanImunisasi = CatatanImunisasi::findOrFail($id);

        $request->validate([
            'warga_id'            => 'required|exists:warga,id',
            'jenis_vaksin'        => 'required|string|max:100',
            'tanggal'             => 'required|date',
            'lokasi'              => 'nullable|string|max:100',
            'nakes'               => 'nullable|string|max:100',
            'files.*'             => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'captions.*'          => 'nullable|string|max:255',
            'existing_captions.*' => 'nullable|string|max:255',
            'delete_media.*'      => 'nullable',
        ]);

        $catatanImunisasi->update([
            'warga_id'     => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal'      => $request->tanggal,
            'lokasi'       => $request->lokasi,
            'nakes'        => $request->nakes,
        ]);

        // Update caption media lama
        if ($request->has('existing_captions')) {
            foreach ($request->existing_captions as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->where('ref_table', 'catatan_imunisasi')
                    ->where('ref_id', $catatanImunisasi->imunisasi_id)
                    ->update(['caption' => $caption]);
            }
        }

        // Hapus media (DISK PUBLIC)
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::where('media_id', $mediaId)
                    ->where('ref_table', 'catatan_imunisasi')
                    ->where('ref_id', $catatanImunisasi->imunisasi_id)
                    ->first();

                if ($media) {
                    Storage::disk('public')->delete('media/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        // Upload media baru (DISK PUBLIC)
        if ($request->hasFile('files')) {
            $existingCount = $catatanImunisasi->media()->count();

            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {

                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    Storage::disk('public')->putFileAs(
                        'media',
                        $file,
                        $fileName
                    );

                    Media::create([
                        'ref_table' => 'catatan_imunisasi',
                        'ref_id'    => $catatanImunisasi->imunisasi_id,
                        'file_name' => $fileName,
                        'caption'   => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order'=> $existingCount + $index,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $catatanImunisasi = CatatanImunisasi::with('media')->findOrFail($id);

        foreach ($catatanImunisasi->media as $media) {
            Storage::disk('public')->delete('media/' . $media->file_name);
            $media->delete();
        }

        $catatanImunisasi->delete();

        return redirect()
            ->route('admin.catatan-imunisasi.index')
            ->with('success', 'Catatan imunisasi berhasil dihapus.');
    }

    /**
     * Hapus file media tunggal
     */
    public function deleteMedia($id, Media $media)
    {
        $catatanImunisasi = CatatanImunisasi::findOrFail($id);

        if (
            $media->ref_table === 'catatan_imunisasi' &&
            $media->ref_id === $catatanImunisasi->imunisasi_id
        ) {
            Storage::disk('public')->delete('media/' . $media->file_name);
            $media->delete();

            return back()->with('success', 'File berhasil dihapus.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
