<!-- resources/views/pages/jadwal_posyandu/create.blade.php -->
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal Posyandu
        </h2>
        <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
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

    <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-calendar-plus"></i> Form Data Jadwal Posyandu
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="nama_posyandu" class="form-label">Nama Posyandu <span class="text-danger">*</span></label>
                            <input type="text" name="nama_posyandu" value="{{ old('nama_posyandu') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema <span class="text-danger">*</span></label>
                            <input type="text" name="tema" value="{{ old('tema') }}" class="form-control" maxlength="200" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section Upload File -->
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="bi bi-files"></i> Upload File Pendukung (Poster/Tata Cara/Arahan)
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
                                        <input type="text" name="captions[]" class="form-control" placeholder="Contoh: Poster kegiatan">
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
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Data
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
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
                    <input type="text" name="captions[]" class="form-control" placeholder="Contoh: Poster kegiatan">
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
