<!-- resources/views/pages/catatan_imunisasi/edit.blade.php -->
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-pencil-square"></i> Edit Catatan Imunisasi
        </h2>
        <a href="{{ route('admin.catatan-imunisasi.show', $catatanImunisasi->imunisasi_id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Detail
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catatan-imunisasi.update', $catatanImunisasi->imunisasi_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-file-medical"></i> Edit Data Catatan Imunisasi
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="warga_id" class="form-label">Warga <span class="text-danger">*</span></label>
                            <select name="warga_id" class="form-control" required>
                                <option value="">Pilih Warga</option>
                                @foreach($warga as $item)
                                    <option value="{{ $item->id }}" {{ old('warga_id', $catatanImunisasi->warga_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }} (NIK: {{ $item->nik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_vaksin" class="form-label">Jenis Vaksin <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_vaksin" value="{{ old('jenis_vaksin', $catatanImunisasi->jenis_vaksin) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $catatanImunisasi->tanggal) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $catatanImunisasi->lokasi) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="nakes" class="form-label">Nama Tenaga Kesehatan</label>
                            <input type="text" name="nakes" value="{{ old('nakes', $catatanImunisasi->nakes) }}" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- File yang sudah ada -->
                @if($catatanImunisasi->media->count() > 0)
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="bi bi-files"></i> File Yang Sudah Ada
                        <span class="badge bg-primary">{{ $catatanImunisasi->media->count() }} file</span>
                    </h5>

                    <div class="row">
                        @foreach($catatanImunisasi->media as $media)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="delete_media[]" value="{{ $media->media_id }}" id="delete_media_{{ $media->media_id }}">
                                        <label class="form-check-label text-danger" for="delete_media_{{ $media->media_id }}">
                                            <i class="bi bi-trash"></i> Hapus file ini
                                        </label>
                                    </div>

                                    @if($media->is_image)
                                        <img src="{{ $media->file_url }}"
                                             alt="{{ $media->caption }}"
                                             class="img-fluid rounded mb-2"
                                             style="height: 100px; object-fit: cover;">
                                    @elseif($media->is_pdf)
                                        <div class="bg-danger text-white rounded d-flex align-items-center justify-content-center mb-2"
                                             style="height: 100px;">
                                            <i class="bi bi-file-earmark-pdf fs-1"></i>
                                        </div>
                                    @elseif($media->is_word)
                                        <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center mb-2"
                                             style="height: 100px;">
                                            <i class="bi bi-file-earmark-word fs-1"></i>
                                        </div>
                                    @elseif($media->is_excel)
                                        <div class="bg-success text-white rounded d-flex align-items-center justify-content-center mb-2"
                                             style="height: 100px;">
                                            <i class="bi bi-file-earmark-excel fs-1"></i>
                                        </div>
                                    @else
                                        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mb-2"
                                             style="height: 100px;">
                                            <i class="bi bi-file-earmark fs-1"></i>
                                        </div>
                                    @endif

                                    <input type="text"
                                           name="existing_captions[{{ $media->media_id }}]"
                                           value="{{ $media->caption }}"
                                           class="form-control form-control-sm mt-2"
                                           placeholder="Caption">

                                    <small class="text-muted d-block">{{ $media->file_name }}</small>

                                    <div class="mt-2 d-flex gap-1">
                                        <a href="{{ $media->file_url }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary flex-fill">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        <a href="{{ $media->file_url }}"
                                           download
                                           class="btn btn-sm btn-outline-success flex-fill">
                                            <i class="bi bi-download"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Upload File Baru -->
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="bi bi-cloud-upload"></i> Upload File Baru
                    </h5>

                    <div id="file-upload-container">
                        <div class="file-upload-item mb-3 border rounded p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">File <small class="text-muted">(Gambar/PDF/DOC/Excel)</small></label>
                                        <input type="file" name="files[]" class="form-control" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                                        <div class="form-text">Maksimal 5MB per file</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Caption/Keterangan</label>
                                        <input type="text" name="captions[]" class="form-control" placeholder="Contoh: Kartu imunisasi">
                                    </div>
                                </div>
                            </div>
                            <div id="image-preview-0" class="mb-3" style="display: none;">
                                <img id="preview-img-0" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-file-btn" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah File Lain
                    </button>
                </div>
            </div>

            <div class="card-footer bg-light text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.catatan-imunisasi.show', $catatanImunisasi->imunisasi_id) }}" class="btn btn-info">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
                <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </form>
</div>

<script>
let fileIndex = 1;

document.getElementById('add-file-btn').addEventListener('click', function() {
    const container = document.getElementById('file-upload-container');
    const newItem = document.createElement('div');
    newItem.className = 'file-upload-item mb-3 border rounded p-3';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">File <small class="text-muted">(Gambar/PDF/DOC/Excel)</small></label>
                    <input type="file" name="files[]" class="form-control file-input" data-index="${fileIndex}" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                    <div class="form-text">Maksimal 5MB per file</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Caption/Keterangan</label>
                    <input type="text" name="captions[]" class="form-control" placeholder="Contoh: Kartu imunisasi">
                </div>
            </div>
        </div>
        <div id="image-preview-${fileIndex}" class="mb-3" style="display: none;">
            <img id="preview-img-${fileIndex}" class="img-thumbnail" style="max-width: 200px;">
        </div>
        <button type="button" class="btn btn-danger btn-sm remove-file-btn">
            <i class="bi bi-trash"></i> Hapus File Ini
        </button>
    `;
    container.appendChild(newItem);
    fileIndex++;
});

// Event delegation untuk preview gambar dan hapus
document.addEventListener('click', function(e) {
    // Handle hapus file
    if (e.target.closest('.remove-file-btn')) {
        e.target.closest('.file-upload-item').remove();
    }
});

// Event delegation untuk preview gambar
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('file-input')) {
        const index = e.target.dataset.index || 0;
        const file = e.target.files[0];
        const preview = document.getElementById(`image-preview-${index}`);
        const previewImg = document.getElementById(`preview-img-${index}`);

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }
});

// Untuk file input pertama
document.querySelector('input[name="files[]"]')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview-0');
    const previewImg = document.getElementById('preview-img-0');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>

<style>
.file-upload-item {
    background-color: #f8f9fa;
}
.file-upload-item:hover {
    background-color: #e9ecef;
}
</style>
@endsection
