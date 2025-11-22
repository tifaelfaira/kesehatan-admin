@extends('layouts.admin.app')

@section('content')
<div class="container">
    {{-- Header dengan total data --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Data Warga</h2>
        <div>
            <span class="badge bg-success me-2">Total: {{ $warga->total() }} Warga</span>
            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Tambah Warga
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TAMBAH INI: Form Filter --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <i class="bi bi-funnel"></i> Filter Data
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('warga.index') }}" class="row g-3">
                {{-- Filter Jenis Kelamin --}}
                <div class="col-md-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Filter Pekerjaan --}}
                <div class="col-md-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <select name="pekerjaan" id="pekerjaan" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Pekerjaan</option>
                        @foreach($pekerjaanList as $pekerjaan)
                            <option value="{{ $pekerjaan }}" {{ request('pekerjaan') == $pekerjaan ? 'selected' : '' }}>
                                {{ $pekerjaan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Reset --}}
                <div class="col-md-3 d-flex align-items-end">
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filter
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel data --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Pekerjaan</th>
                            <th>Alamat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $index => $item)
                        <tr>
                            <td class="text-center">{{ $warga->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $item->nama }}</strong>
                                @if($item->rt_rw)
                                    <br><small class="text-muted">RT/RW: {{ $item->rt_rw }}</small>
                                @endif
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td class="text-center">{{ $item->jenis_kelamin }}</td>
                            <td class="text-center">{{ $item->umur }} thn</td>
                            <td>{{ $item->pekerjaan ?: '-' }}</td>
                            <td>
                                <small>{{ Str::limit($item->alamat, 50) }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- Edit --}}
                                    <a href="{{ route('warga.edit', $item->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Detail --}}
                                    @if(method_exists($item, 'show'))
                                    <a href="{{ route('warga.show', $item->id) }}" 
                                       class="btn btn-info btn-sm" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @endif

                                    {{-- Hapus --}}
                                    <form action="{{ route('warga.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin hapus data warga ini?')"
                                                title="Hapus">
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
                                    <i class="bi bi-people" style="font-size: 3rem;"></i>
                                    <p class="mt-2">Belum ada data warga</p>
                                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
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
        {{ $warga->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection