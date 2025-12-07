@extends('layouts.admin.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container">
  <h4 class="mb-4">👥 Detail Pelanggan</h4>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-info-circle"></i> Informasi Pelanggan
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th width="30%">Nama</th>
              <td>{{ $pelanggan->nama }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $pelanggan->email }}</td>
            </tr>
            <tr>
              <th>Telepon</th>
              <td>{{ $pelanggan->telepon ?? '-' }}</td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>{{ $pelanggan->alamat ?? '-' }}</td>
            </tr>
          </table>
        </div>
      </div>
      
      <div class="mt-3">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning">
          <i class="bi bi-pencil"></i> Edit Data
        </a>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-success text-white">
          <i class="bi bi-files"></i> File Pendukung
        </div>
        <div class="card-body">
          <!-- Form Upload Multiple File -->
          <form method="POST" action="{{ route('multipleuploads.store') }}" enctype="multipart/form-data" class="mb-4">
            @csrf
            <input type="hidden" name="ref_table" value="pelanggan">
            <input type="hidden" name="ref_id" value="{{ $pelanggan->id }}">
            
            <div class="form-group mb-3">
              <label for="filename" class="form-label fw-bold">Upload File Pendukung</label>
              <input type="file" class="form-control" name="filename[]" required multiple 
                     accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
              <div class="form-text">
                <i class="bi bi-info-circle"></i> Pilih multiple file sekaligus (doc, pdf, jpg, png) - maksimal 2MB per file
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-upload"></i> Upload Files
            </button>
          </form>

          <hr>

          <!-- List File yang sudah diupload -->
          <h6 class="fw-bold mb-3">File Terupload:</h6>
          
          @if($files->count() > 0)
            <div class="row">
              @foreach($files as $file)
              <div class="col-md-12 mb-3">
                <div class="card file-card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-md-2 text-center">
                        @if(in_array(pathinfo($file->filename, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']))
                          <img src="{{ asset($file->filename) }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                          <i class="bi bi-file-earmark-text fa-2x text-secondary"></i>
                        @endif
                      </div>
                      <div class="col-md-6">
                        <p class="mb-1 fw-bold">{{ basename($file->filename) }}</p>
                        <small class="text-muted">
                          Uploaded: {{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y H:i') }}
                        </small>
                      </div>
                      <div class="col-md-4 text-end">
                        <div class="btn-group">
                          <a href="{{ asset($file->filename) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Download">
                            <i class="bi bi-download"></i> Download
                          </a>
                          <form action="{{ route('multipleuploads.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus file ini?')" title="Hapus">
                              <i class="bi bi-trash"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-4">
              <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
              <p class="text-muted mt-2">Belum ada file yang diupload</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.file-card {
  transition: transform 0.2s;
  border-left: 4px solid #28a745;
}
.file-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endsection