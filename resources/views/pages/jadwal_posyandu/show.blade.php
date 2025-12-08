@extends('layouts.admin.app')

@section('content')
<div class="container">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">
                <i class="bi bi-calendar-check me-2"></i>Detail Jadwal Posyandu
            </h2>
            <p class="text-muted mb-0">Informasi lengkap tentang jadwal posyandu</p>
        </div>
        <div>
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="col-md-8">
            {{-- Card Informasi Jadwal --}}
            <div class="card border-primary mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-info-circle me-2"></i>
                    <h5 class="mb-0 fw-semibold">Informasi Jadwal</h5>
                </div>
                <div class="card-body">
                    <h4 class="text-primary mb-3">{{ $jadwal->nama_posyandu }}</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-calendar-date text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Tanggal</div>
                                    <div class="fw-bold">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded me-3">
                                    <i class="bi bi-tag text-primary"></i>
                                </div>
                                <div>
                                    <div class="text-muted small">Tema</div>
                                    <div class="fw-bold">{{ $jadwal->tema }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Garis Pemisah --}}
                    <hr class="my-4">

                    {{-- Keterangan --}}
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="bi bi-card-text text-primary me-2"></i>Keterangan
                    </h5>
                    <div class="p-3 bg-light border-start border-3 border-primary rounded">
                        @if($jadwal->keterangan)
                            {{ $jadwal->keterangan }}
                        @else
                            <span class="text-muted fst-italic">Tidak ada keterangan tambahan</span>
                        @endif
                    </div>

                    {{-- Garis Pemisah --}}
                    <hr class="my-4">

                    {{-- Informasi Waktu --}}
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="bi bi-clock text-primary me-2"></i>Informasi Waktu
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted small mb-1">Hari Pelaksanaan</div>
                                <div class="fw-bold text-primary">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted small mb-1">Minggu ke</div>
                                <div class="fw-bold text-primary">{{ \Carbon\Carbon::parse($jadwal->tanggal)->weekOfMonth }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted small mb-1">Status</div>
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal);
                                @endphp
                                @if($jadwalDate->isPast())
                                    <span class="badge bg-secondary py-2 px-3">Selesai</span>
                                @elseif($jadwalDate->isToday())
                                    <span class="badge bg-success py-2 px-3">Hari Ini</span>
                                @else
                                    <span class="badge bg-primary py-2 px-3">Akan Datang</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Poster dan Aksi --}}
        <div class="col-md-4">
            {{-- Card Poster/Visual --}}
            <div class="card border-secondary mb-4 shadow-sm">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <i class="bi bi-image me-2"></i>
                    <h5 class="mb-0 fw-semibold">Poster/Visual</h5>
                </div>
                <div class="card-body text-center">
                    @if($jadwal->poster)
                        <img src="{{ $jadwal->poster }}" 
                             alt="Poster {{ $jadwal->nama_posyandu }}" 
                             class="img-fluid rounded mb-3 border"
                             style="max-height: 200px; object-fit: cover;">
                        <a href="{{ $jadwal->poster }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Full Size
                        </a>
                    @else
                        <div class="py-4">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="bi bi-image text-muted fs-2"></i>
                            </div>
                            <p class="text-muted mb-0">Tidak ada poster tersedia</p>
                        </div>
                    @endif
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
                        <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}" 
                           class="btn btn-warning d-flex align-items-center justify-content-center">
                            <i class="bi bi-pencil-square me-2"></i>Edit Jadwal
                        </a>
                        
                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-trash me-2"></i>Hapus Jadwal
                            </button>
                        </form>
                        
                        <a href="{{ route('jadwal.create') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                            <i class="bi bi-plus-circle me-2"></i>Buat Jadwal Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi ke Jadwal Lainnya --}}
    <div class="mt-4 d-flex justify-content-between">
        @if($prev)
            <a href="{{ route('jadwal.show', $prev->jadwal_id) }}" class="btn btn-outline-secondary d-flex align-items-center">
                <i class="bi bi-chevron-left me-1"></i>
                <div class="text-start">
                    <div class="small text-muted">Sebelumnya</div>
                    <div class="fw-medium">{{ \Illuminate\Support\Str::limit($prev->nama_posyandu, 25) }}</div>
                </div>
            </a>
        @else
            <div></div>
        @endif
        
        @if($next)
            <a href="{{ route('jadwal.show', $next->jadwal_id) }}" class="btn btn-outline-secondary d-flex align-items-center">
                <div class="text-end">
                    <div class="small text-muted">Selanjutnya</div>
                    <div class="fw-medium">{{ \Illuminate\Support\Str::limit($next->nama_posyandu, 25) }}</div>
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
            Terakhir diupdate: {{ $jadwal->updated_at->translatedFormat('d F Y H:i') }}
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
        background-color: #a4dde7ff !important;
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
        border-color: #3388afff !important;
    }
    .shadow-sm {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection