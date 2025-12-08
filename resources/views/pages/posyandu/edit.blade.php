@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-pencil-square"></i> Edit Posyandu
        </h2>
        <a href="{{ route('admin.posyandu.index') }}" class="btn btn-outline-secondary">
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

    <form action="{{ route('admin.posyandu.update', $posyandu->posyandu_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-house-gear"></i> Edit Data Posyandu
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Posyandu <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', $posyandu->nama) }}" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $posyandu->alamat) }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" name="rt" value="{{ old('rt', $posyandu->rt) }}" class="form-control" maxlength="5">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" name="rw" value="{{ old('rw', $posyandu->rw) }}" class="form-control" maxlength="5">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $posyandu->kontak) }}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Posyandu</label>
                            <div class="border rounded p-3 text-center">
                                @if($posyandu->foto)
                                    <div class="mb-3">
                                        <img src="{{ Storage::url($posyandu->foto) }}" 
                                             alt="Foto {{ $posyandu->nama }}" 
                                             class="img-fluid rounded"
                                             style="max-height: 150px; object-fit: cover;">
                                        <p class="text-muted small mt-2">Foto saat ini</p>
                                    </div>
                                @endif
                                
                                <div id="new-image-preview" class="mb-3" style="display: none;">
                                    <img id="new-preview-img" class="img-fluid rounded" 
                                         style="max-height: 150px; object-fit: cover;">
                                    <p class="text-muted small mt-2">Foto baru</p>
                                </div>
                                
                                <input type="file" name="foto" id="foto" class="form-control" 
                                       accept="image/*" onchange="previewNewImage(event)">
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-info-circle"></i> Kosongkan jika tidak ingin mengubah foto
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-light text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.posyandu.show', $posyandu->posyandu_id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function previewNewImage(event) {
    const input = event.target;
    const preview = document.getElementById('new-preview-img');
    const previewContainer = document.getElementById('new-image-preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
@endsection