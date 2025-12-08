@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">
                <i class="bi bi-house-heart"></i> Detail Posyandu
            </h2>
            <p class="text-muted mb-0">Informasi lengkap tentang posyandu</p>
        </div>
        <div>
            <a href="{{ route('admin.posyandu.edit', $posyandu->posyandu_id) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="{{ route('admin.posyandu.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-info-circle"></i> {{ $posyandu->nama }}
            </h5>
            <form action="{{ route('admin.posyandu.destroy', $posyandu->posyandu_id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus posyandu ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>
        
        <div class="card-body">
            <div class="row">
                {{-- Kolom Kiri: Informasi --}}
                <div class="col-md-8">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 mb-3">
                                <div class="text-muted small">Nama Posyandu</div>
                                <div class="fw-bold fs-5">{{ $posyandu->nama }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 mb-3">
                                <div class="text-muted small">RT/RW</div>
                                <div class="fw-bold fs-5">{{ $posyandu->rt }}/{{ $posyandu->rw }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border rounded p-3 mb-4">
                        <div class="text-muted small mb-2">Alamat</div>
                        <div class="fw-medium">{{ $posyandu->alamat ?: '-' }}</div>
                    </div>
                    
                    <div class="border rounded p-3">
                        <div class="text-muted small mb-2">Kontak</div>
                        <div class="fw-medium">{{ $posyandu->kontak ?: '-' }}</div>
                    </div>
                </div>
                
                {{-- Kolom Kanan: Foto --}}
                <div class="col-md-4">
                    <div class="card border-secondary">
                        <div class="card-header bg-secondary text-white">
                            <i class="bi bi-image"></i> Foto Posyandu
                        </div>
                        <div class="card-body text-center">
                            @if($posyandu->foto)
                                <img src="{{ Storage::url($posyandu->foto) }}" 
                                     alt="Foto {{ $posyandu->nama }}" 
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 250px; object-fit: cover;">
                                <a href="{{ Storage::url($posyandu->foto) }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-box-arrow-up-right"></i> Lihat Full Size
                                </a>
                            @else
                                <div class="py-4">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 80px; height: 80px;">
                                        <i class="bi bi-image text-muted fs-2"></i>
                                    </div>
                                    <p class="text-muted mb-0">Tidak ada foto tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Metadata --}}
            <div class="row mt-4 border-top pt-3">
                <div class="col-md-6">
                    <div class="text-muted small">
                        <i class="bi bi-calendar-plus"></i> 
                        Dibuat: {{ $posyandu->created_at->translatedFormat('d F Y H:i') }}
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="text-muted small">
                        <i class="bi bi-calendar-check"></i> 
                        Terakhir diupdate: {{ $posyandu->updated_at->translatedFormat('d F Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Aksi Cepat --}}
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.posyandu.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Posyandu Baru
                </a>
                <div>
                    @php
                        $prev = \App\Models\Posyandu::where('posyandu_id', '<', $posyandu->posyandu_id)
                            ->latest('posyandu_id')->first();
                        $next = \App\Models\Posyandu::where('posyandu_id', '>', $posyandu->posyandu_id)
                            ->oldest('posyandu_id')->first();
                    @endphp
                    
                    @if($prev)
                        <a href="{{ route('admin.posyandu.show', $prev->posyandu_id) }}" 
                           class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-chevron-left"></i> Sebelumnya
                        </a>
                    @endif
                    
                    @if($next)
                        <a href="{{ route('admin.posyandu.show', $next->posyandu_id) }}" 
                           class="btn btn-outline-secondary btn-sm ms-2">
                            Selanjutnya <i class="bi bi-chevron-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection