@extends('layouts.admin.app')

@section('title', 'Data Layanan Posyandu')

@section('content')
<div class="container py-4">

    {{-- Header dan tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Data Layanan Posyandu</h3>
        <div>
            <span class="badge bg-success me-2">Total: {{ $data->total() }} Data</span>
            <a href="{{ route('admin.layanan-posyandu.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Layanan
            </a>
        </div>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Filter & Search --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <i class="bi bi-funnel"></i> Filter & Pencarian Data
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.layanan-posyandu.index') }}" class="row g-3">
                {{-- Filter Jadwal Posyandu --}}
                <div class="col-md-2">
                    <label for="jadwal_id" class="form-label">Jadwal Posyandu</label>
                    <select name="jadwal_id" id="jadwal_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jadwal</option>
                        @foreach($jadwalList as $jadwal)
                            <option value="{{ $jadwal->jadwal_id }}" {{ request('jadwal_id') == $jadwal->jadwal_id ? 'selected' : '' }}>
                                {{ $jadwal->nama_posyandu }} - {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Warga --}}
                <div class="col-md-2">
                    <label for="warga_id" class="form-label">Nama Warga</label>
                    <select name="warga_id" id="warga_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Warga</option>
                        @foreach($wargaList as $warga)
                            <option value="{{ $warga->id }}" {{ request('warga_id') == $warga->id ? 'selected' : '' }}>
                                {{ $warga->nama }} ({{ $warga->umur }} thn)
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Vitamin --}}
                <div class="col-md-2">
                    <label for="vitamin" class="form-label">Jenis Vitamin</label>
                    <select name="vitamin" id="vitamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Vitamin</option>
                        @foreach($vitaminList as $vitamin)
                            <option value="{{ $vitamin }}" {{ request('vitamin') == $vitamin ? 'selected' : '' }}>
                                {{ $vitamin }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TAMBAH INI: Search --}}
                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                               value="{{ request('search') }}" 
                               placeholder="Cari jenis vitamin atau konseling..." 
                               aria-label="Search">
                        <button type="submit" class="input-group-text" id="basic-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                        {{-- Clear Search --}}
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                               class="btn btn-outline-secondary ms-2" 
                               id="clear-search">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.layanan-posyandu.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Hasil Pencarian --}}
    @if(request('search'))
        <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle"></i> 
            Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
            <span class="badge bg-primary ms-2">{{ $data->total() }} data ditemukan</span>
        </div>
    @endif

    {{-- Tabel data --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Warga</th>
                            <th>Jadwal Posyandu</th>
                            <th>Berat (kg)</th>
                            <th>Tinggi (cm)</th>
                            <th>Vitamin</th>
                            <th>Konseling</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $i => $row)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $i }}</td>

                                {{-- Nama warga --}}
                                <td>
                                    @if($row->warga)
                                        <strong>{{ $row->warga->nama }}</strong>
                                        @if($row->warga->jenis_kelamin)
                                            <br><small class="text-muted">{{ $row->warga->jenis_kelamin }}</small>
                                        @endif
                                        @if($row->warga->umur)
                                            <br><small class="text-muted">{{ $row->warga->umur }} tahun</small>
                                        @endif
                                    @else
                                        <span class="text-danger">Warga tidak ditemukan</span>
                                    @endif
                                </td>

                                {{-- Jadwal Posyandu --}}
                                <td>
                                    @if($row->jadwal)
                                        <strong>{{ $row->jadwal->nama_posyandu }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($row->jadwal->tanggal)->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-info">{{ $row->jadwal->tema }}</small>
                                    @else
                                        <span class="text-danger">Jadwal tidak ditemukan</span>
                                    @endif
                                </td>

                                <td class="text-center">{{ number_format($row->berat, 1) }} kg</td>
                                <td class="text-center">{{ number_format($row->tinggi, 1) }} cm</td>
                                <td>{{ $row->vitamin ?: '-' }}</td>
                                <td>{{ $row->konseling ?: '-' }}</td>

                                {{-- Aksi edit & hapus --}}
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.layanan-posyandu.edit', $row->layanan_id) }}"
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.layanan-posyandu.destroy', $row->layanan_id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Belum ada data layanan posyandu</p>
                                        <a href="{{ route('admin.layanan-posyandu.create') }}" class="btn btn-primary btn-sm">
                                            Tambah Data Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection