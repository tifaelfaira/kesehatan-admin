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
        <div class="col-md-8">
            {{-- Card Informasi Catatan Imunisasi --}}
            <div class="card border-primary mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-info-circle me-2"></i>
                    <h5 class="mb-0 fw-semibold">Informasi Catatan Imunisasi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Nama Warga</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->warga->nama ?? '-' }}</div>
                                    <div class="text-muted small">NIK: {{ $catatanImunisasi->warga->nik ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-shield-plus text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Jenis Vaksin</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->jenis_vaksin }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-calendar-date text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Tanggal Imunisasi</div>
                                    <div class="fw-bold">{{ \Carbon\Carbon::parse($catatanImunisasi->tanggal)->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Lokasi</div>
                                    <div class="fw-bold">{{ $catatanImunisasi->lokasi ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary-subtle p-2 rounded me-3">
                            <i class="bi bi-person-badge text-primary"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Nama Tenaga Kesehatan</div>
                            <div class="fw-bold">{{ $catatanImunisasi->nakes ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: File dan Aksi --}}
        <div class="col-md-4">
            {{-- Card File Dokumen --}}
            <div class="card border-secondary mb-4 shadow-sm">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="bi bi-files me-2"></i>
                    <h5 class="mb-0 fw-semibold">Kartu Imunisasi/Dokumen</h5>
                    @if($catatanImunisasi->media->count() > 0)
                        <span class="badge bg-light text-dark ms-2">{{ $catatanImunisasi->media->count() }} file</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($catatanImunisasi->media->count() > 0)
                        <div class="list-group">
                            @foreach($catatanImunisasi->media as $media)
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @if($media->is_image)
                                        <i class="bi bi-image text-primary me-2"></i>
                                    @elseif($media->is_pdf)
                                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                    @elseif($media->is_word)
                                        <i class="bi bi-file-earmark-word text-primary me-2"></i>
                                    @elseif($media->is_excel)
                                        <i class="bi bi-file-earmark-excel text-success me-2"></i>
                                    @else
                                        <i class="bi bi-file-earmark text-secondary me-2"></i>
                                    @endif
                                    <div>
                                        <div class="fw-medium">{{ $media->caption ?: 'File' }}</div>
                                        <small class="text-muted">{{ $media->file_name }}</small>
                                    </div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ $media->file_url }}"
                                       target="_blank"
                                       class="btn btn-outline-primary"
                                       title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ $media->file_url }}"
                                       download
                                       class="btn btn-outline-success"
                                       title="Unduh">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <form action="{{ route('admin.catatan-imunisasi.delete-media', ['id' => $catatanImunisasi->imunisasi_id, 'media' => $media->media_id]) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus file ini?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width: 80px; height: 80px;">
                                <i class="bi bi-files text-muted fs-2"></i>
                            </div>
                            <p class="text-muted mb-0">Belum ada file dokumen</p>
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('admin.catatan-imunisasi.edit', $catatanImunisasi->imunisasi_id) }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-plus-circle me-1"></i> Tambah/Ubah File
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Aksi Cepat --}}
            <div class="card border-warning shadow-sm">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-lightning-charge me-2"></i>
                    <h5 class="mb-0 fw-semibold">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.catatan-imunisasi.edit', $catatanImunisasi->imunisasi_id) }}"
                           class="btn btn-warning d-flex align-items-center justify-content-center">
                            <i class="bi bi-pencil-square me-2"></i>Edit Catatan
                        </a>

                        <form action="{{ route('admin.catatan-imunisasi.destroy', $catatanImunisasi->imunisasi_id) }}"
                              method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-trash me-2"></i>Hapus Catatan
                            </button>
                        </form>

                        <a href="{{ route('admin.catatan-imunisasi.create') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                            <i class="bi bi-plus-circle me-2"></i>Buat Catatan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi ke Catatan Lainnya --}}
    <div class="mt-4 d-flex justify-content-between">
        @if($prev)
            <a href="{{ route('admin.catatan-imunisasi.show', $prev->imunisasi_id) }}" class="btn btn-outline-secondary d-flex align-items-center">
                <i class="bi bi-chevron-left me-1"></i>
                <div class="text-start">
                    <div class="small text-muted">Sebelumnya</div>
                    <div class="fw-medium">{{ $prev->warga->nama ?? 'Catatan' }}</div>
                </div>
            </a>
        @else
            <div></div>
        @endif

        @if($next)
            <a href="{{ route('admin.catatan-imunisasi.show', $next->imunisasi_id) }}" class="btn btn-outline-secondary d-flex align-items-center">
                <div class="text-end">
                    <div class="small text-muted">Selanjutnya</div>
                    <div class="fw-medium">{{ $next->warga->nama ?? 'Catatan' }}</div>
                </div>
                <i class="bi bi-chevron-right ms-1"></i>
            </a>
        @else
            <div></div>
        @endif
    </div>

    {{-- Footer Metadata --}}
    <div class="mt-4 pt-3 border-top text-center">
        <p class="text-muted small mb-0">
            <i class="bi bi-info-circle me-1"></i>
            Terakhir diupdate: {{ $catatanImunisasi->updated_at->translatedFormat('d F Y H:i') }}
        </p>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
        padding: 1rem 1.25rem;
    }
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
    .bg-secondary {
        background-color: #6c757d !important;
    }
    .bg-warning {
        background-color: #ffc107 !important;
    }
    .badge {
        border-radius: 20px;
    }
    .btn {
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: 500;
    }
    .border {
        border-color: #e0e0e0 !important;
    }
    .border-primary {
        border-color: #0d6efd !important;
    }
    .border-secondary {
        border-color: #6c757d !important;
    }
    .border-warning {
        border-color: #ffc107 !important;
    }
    .shadow-sm {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection
