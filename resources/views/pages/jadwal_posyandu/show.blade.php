@extends('layouts.admin.app')

@section('content')
    <div class="container">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">
                    <i class="bi bi-calendar-check me-2"></i> Detail Jadwal Posyandu
                </h2>
                <p class="text-muted mb-0">Informasi lengkap tentang jadwal posyandu</p>
            </div>
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            {{-- ================= KIRI ================= --}}
            <div class="col-md-8">
                <div class="card border-primary shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-info-circle me-2"></i> Informasi Jadwal
                    </div>

                    <div class="card-body">
                        <h4 class="text-primary mb-3">{{ $jadwal->nama_posyandu }}</h4>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle p-2 rounded me-3">
                                        <i class="bi bi-calendar-date text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Tanggal</small>
                                        <div class="fw-bold">
                                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle p-2 rounded me-3">
                                        <i class="bi bi-tag text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted">Tema</small>
                                        <div class="fw-bold">{{ $jadwal->tema }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Keterangan --}}
                        <h5 class="mb-2">
                            <i class="bi bi-card-text text-primary me-2"></i>Keterangan
                        </h5>
                        <div class="p-3 bg-light border-start border-3 border-primary rounded">
                            {{ $jadwal->keterangan ?? 'Tidak ada keterangan tambahan' }}
                        </div>

                        <hr>

                        {{-- Status --}}
                        @php
                            $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal);
                        @endphp

                        <div class="mt-3">
                            @if ($jadwalDate->isPast())
                                <span class="badge bg-secondary">Selesai</span>
                            @elseif ($jadwalDate->isToday())
                                <span class="badge bg-success">Hari Ini</span>
                            @else
                                <span class="badge bg-primary">Akan Datang</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= KANAN ================= --}}
            <div class="col-md-4">

                {{-- File Pendukung --}}
                <div class="card border-secondary shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-files me-2"></i> File Pendukung
                    </div>

                    <div class="card-body">
                        @if ($jadwal->media->count())
                            <div class="list-group">
                                @foreach ($jadwal->media as $media)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $media->caption ?? 'File' }}</strong><br>
                                            <small class="text-muted">{{ $media->file_name }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center">Belum ada file pendukung</p>
                        @endif

                        <p></p>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ $media->file_url }}" target="_blank" class="btn btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ $media->file_url }}" download class="btn btn-outline-success">
                                <i class="bi bi-download"></i>
                            </a>
                            <form
                                action="{{ route('jadwal.delete-media', [
                                    'jadwal_id' => $jadwal->jadwal_id,
                                    'media' => $media->media_id,
                                ]) }}"
                                method="POST" onsubmit="return confirm('Hapus file ini?')">
                                @csrf
                                <button class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}"
                            class="btn btn-outline-secondary w-100 mt-3">
                            <i class="bi bi-plus-circle me-1"></i> Tambah / Ubah File
                        </a>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="card border-warning shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-lightning-charge me-2"></i> Aksi Cepat
                    </div>
                    <div class="card-body d-grid gap-2">
                        <a href="{{ route('jadwal.edit', $jadwal->jadwal_id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-1"></i> Edit Jadwal
                        </a>

                        <form action="{{ route('jadwal.destroy', $jadwal->jadwal_id) }}" method="POST"
                            onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100">
                                <i class="bi bi-trash me-1"></i> Hapus Jadwal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
