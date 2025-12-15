<!-- resources/views/pages/catatan_imunisasi/show.blade.php -->
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">
                <i class="bi bi-file-medical me-2"></i>Detail Catatan Imunisasi
            </h2>
            <p class="text-muted mb-0">Informasi lengkap tentang catatan imunisasi</p>
        </div>
        <div>
            <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="col-lg-8 mb-4">
            {{-- Card Informasi Catatan Imunisasi --}}
            <div class="card border-primary shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center py-2">
                    <i class="bi bi-info-circle me-2 fs-5"></i>
                    <h5 class="mb-0 fw-semibold">Informasi Catatan Imunisasi</h5>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small mb-1">Nama Warga</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->warga->nama ?? '-' }}</div>
                                    <div class="text-muted small mt-1">NIK: {{ $catatanImunisasi->warga->nik ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-shield-plus text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small mb-1">Jenis Vaksin</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->jenis_vaksin }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-calendar-date text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small mb-1">Tanggal Imunisasi</div>
                                    <div class="fw-bold">{{ \Carbon\Carbon::parse($catatanImunisasi->tanggal)->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small mb-1">Lokasi</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->lokasi ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary-subtle p-2 rounded me-3">
                            <i class="bi bi-person-badge text-primary"></i>
                        </div>
                        <div>
                            <div class="text-muted small mb-1">Nama Tenaga Kesehatan</div>
                            <div class="fw-bold">{{ $catatanImunisasi->nakes ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: File dan Aksi --}}
        <div class="col-lg-4">
            {{-- Card File Dokumen --}}
            <div class="card border-secondary shadow-sm mb-4">
                <div class="card-header bg-secondary text-white d-flex align-items-center py-2">
                    <i class="bi bi-files me-2"></i>
                    <h5 class="mb-0 fw-semibold">Kartu Imunisasi/Dokumen</h5>
                    @if($catatanImunisasi->media->count() > 0)
                        <span class="badge bg-light text-dark ms-2">{{ $catatanImunisasi->media->count() }} file</span>
                    @endif
                </div>
                <div class="card-body p-3">
                    @if($catatanImunisasi->media->count() > 0)
                        <div class="file-list">
                            @foreach($catatanImunisasi->media as $media)
                            <div class="file-item mb-3 p-3 border rounded bg-light">
                                <div class="d-flex align-items-start">
                                    <div class="file-icon me-3">
                                        @if($media->is_image)
                                            <div class="bg-primary p-2 rounded">
                                                <i class="bi bi-image text-white"></i>
                                            </div>
                                        @elseif($media->is_pdf)
                                            <div class="bg-danger p-2 rounded">
                                                <i class="bi bi-file-earmark-pdf text-white"></i>
                                            </div>
                                        @elseif($media->is_word)
                                            <div class="bg-primary p-2 rounded">
                                                <i class="bi bi-file-earmark-word text-white"></i>
                                            </div>
                                        @elseif($media->is_excel)
                                            <div class="bg-success p-2 rounded">
                                                <i class="bi bi-file-earmark-excel text-white"></i>
                                            </div>
                                        @else
                                            <div class="bg-secondary p-2 rounded">
                                                <i class="bi bi-file-earmark text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="file-info flex-grow-1">
                                        <h6 class="fw-bold mb-1 text-truncate">{{ $media->caption ?: 'File' }}</h6>
                                        <p class="text-muted small mb-2">{{ Str::limit($media->file_name, 20) }}</p>
                                        <small class="badge bg-info">
                                            @if($media->is_image) Gambar @elseif($media->is_pdf) PDF @elseif($media->is_word) Word @elseif($media->is_excel) Excel @else Dokumen @endif
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="file-actions mt-3 pt-3 border-top">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ $media->file_url }}"
                                           target="_blank"
                                           class="btn btn-primary btn-sm d-flex align-items-center"
                                           title="Lihat File">
                                            <i class="bi bi-eye me-1"></i> Lihat
                                        </a>
                                        <a href="{{ $media->file_url }}"
                                           download="{{ $media->file_name }}"
                                           class="btn btn-success btn-sm d-flex align-items-center"
                                           title="Unduh File">
                                            <i class="bi bi-download me-1"></i> Unduh
                                        </a>
                                        <form action="{{ route('admin.catatan-imunisasi.delete-media', ['id' => $catatanImunisasi->imunisasi_id, 'media' => $media->media_id]) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm d-flex align-items-center"
                                                    title="Hapus File"
                                                    onclick="return confirm('Yakin hapus file ini?')">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 70px; height: 70px;">
                                <i class="bi bi-files text-muted"></i>
                            </div>
                            <p class="text-muted mb-0">Belum ada file dokumen</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.catatan-imunisasi.edit', $catatanImunisasi->imunisasi_id) }}" 
                           class="btn btn-outline-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-plus-circle me-2"></i> Tambah/Ubah File
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Aksi Cepat --}}
            <div class="card border-warning shadow-sm">
                <div class="card-header bg-warning text-dark d-flex align-items-center py-2">
                    <i class="bi bi-lightning-charge me-2"></i>
                    <h5 class="mb-0 fw-semibold">Aksi Cepat</h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.catatan-imunisasi.edit', $catatanImunisasi->imunisasi_id) }}"
                           class="btn btn-warning py-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-pencil-square me-2"></i> Edit Catatan
                        </a>

                        <form action="{{ route('admin.catatan-imunisasi.destroy', $catatanImunisasi->imunisasi_id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger w-100 py-2 d-flex align-items-center justify-content-center"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                <i class="bi bi-trash me-2"></i> Hapus Catatan
                            </button>
                        </form>

                        <a href="{{ route('admin.catatan-imunisasi.create') }}" 
                           class="btn btn-outline-primary py-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-plus-circle me-2"></i> Buat Catatan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi ke Catatan Lainnya --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                @if($prev)
                    <a href="{{ route('admin.catatan-imunisasi.show', $prev->imunisasi_id) }}" 
                       class="btn btn-outline-secondary d-flex align-items-center px-4 py-2">
                        <i class="bi bi-chevron-left me-2"></i>
                        <div class="text-start">
                            <div class="small text-muted">Sebelumnya</div>
                            <div class="fw-medium">{{ $prev->warga->nama ?? 'Catatan' }}</div>
                        </div>
                    </a>
                @else
                    <div></div>
                @endif

                @if($next)
                    <a href="{{ route('admin.catatan-imunisasi.show', $next->imunisasi_id) }}" 
                       class="btn btn-outline-secondary d-flex align-items-center px-4 py-2">
                        <div class="text-end">
                            <div class="small text-muted">Selanjutnya</div>
                            <div class="fw-medium">{{ $next->warga->nama ?? 'Catatan' }}</div>
                        </div>
                        <i class="bi bi-chevron-right ms-2"></i>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer Metadata --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="pt-3 border-top text-center">
                <p class="text-muted small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Terakhir diupdate: {{ $catatanImunisasi->updated_at->translatedFormat('d F Y H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .card-header {
        border-bottom: none;
        padding: 0.75rem 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.08) !important;
    }
    
    .bg-secondary {
        background-color: #5a6268 !important;
    }
    
    .bg-warning {
        background-color: #e0a800 !important;
    }
    
    .badge {
        border-radius: 15px;
        font-weight: 500;
        padding: 0.25em 0.6em;
        font-size: 0.85rem;
    }
    
    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.875rem;
    }
    
    .border {
        border-color: #dee2e6 !important;
    }
    
    .border-primary {
        border-color: #0d6efd !important;
        border-width: 1px;
    }
    
    .border-secondary {
        border-color: #5a6268 !important;
        border-width: 1px;
    }
    
    .border-warning {
        border-color: #e0a800 !important;
        border-width: 1px;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 6px rgba(0,0,0,0.06) !important;
    }
    
    .file-item {
        background-color: #f8f9fa;
        border-color: #e9ecef !important;
        transition: all 0.3s ease;
    }
    
    .file-item:hover {
        background-color: #ffffff;
        border-color: #0d6efd !important;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.08);
    }
    
    .file-icon .bg-primary,
    .file-icon .bg-danger,
    .file-icon .bg-success,
    .file-icon .bg-secondary {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .file-info h6 {
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }
    
    .file-actions {
        border-top: 1px solid rgba(0,0,0,0.06);
    }
    
    .text-truncate {
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .fw-bold {
        font-weight: 600 !important;
        color: #2c3e50;
    }
    
    .bg-info {
        background-color: #17a2b8 !important;
    }
    
    .small {
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 0.875rem;
        }
        
        .card-header {
            padding: 0.625rem 0.875rem;
        }
        
        .file-icon .bg-primary,
        .file-icon .bg-danger,
        .file-icon .bg-success,
        .file-icon .bg-secondary {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
        
        .file-actions .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        
        .btn {
            padding: 0.5rem 0.875rem;
        }
    }
</style>
@endsection