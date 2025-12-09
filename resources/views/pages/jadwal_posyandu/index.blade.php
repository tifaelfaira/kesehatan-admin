<!-- resources/views/pages/jadwal_posyandu/index.blade.php -->
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Daftar Jadwal Posyandu</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
        <span class="badge bg-success">Total: {{ $jadwal->total() }} Data</span>
    </div>

    {{-- Form Filter & Search --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <i class="bi bi-funnel"></i> Filter & Pencarian Data
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('jadwal.index') }}" class="row g-3">
                {{-- Filter Nama Posyandu --}}
                <div class="col-md-3">
                    <label for="nama_posyandu" class="form-label">Nama Posyandu</label>
                    <select name="nama_posyandu" id="nama_posyandu" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Posyandu</option>
                        @foreach($namaPosyanduList as $nama)
                            <option value="{{ $nama }}" {{ request('nama_posyandu') == $nama ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Tema --}}
                <div class="col-md-3">
                    <label for="tema" class="form-label">Tema</label>
                    <select name="tema" id="tema" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tema</option>
                        @foreach($temaList as $tema)
                            <option value="{{ $tema }}" {{ request('tema') == $tema ? 'selected' : '' }}>
                                {{ $tema }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Search --}}
                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Cari nama posyandu, tema, atau keterangan..."
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
                    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary w-100">
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
            <span class="badge bg-primary ms-2">{{ $jadwal->total() }} data ditemukan</span>
        </div>
    @endif

    {{-- Tabel Data --}}
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Posyandu</th>
                <th>Tema</th>
                <th>Keterangan</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $index => $j)
                <tr>
                    <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $j->nama_posyandu }}</td>
                    <td>{{ $j->tema }}</td>
                    <td>{{ $j->keterangan ?: '-' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $j->media->count() }} file</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('jadwal.show', $j->jadwal_id) }}"
                               class="btn btn-info btn-sm"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('jadwal.edit', $j->jadwal_id) }}"
                               class="btn btn-warning btn-sm"
                               title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('jadwal.destroy', $j->jadwal_id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $jadwal->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
