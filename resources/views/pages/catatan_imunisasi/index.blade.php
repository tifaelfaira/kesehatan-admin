<!-- resources/views/pages/catatan_imunisasi/index.blade.php -->
@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Catatan Imunisasi</h2>
        <a href="{{ route('admin.catatan-imunisasi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Catatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- FORM FILTER DAN SEARCH -->
            <form method="GET" action="{{ route('admin.catatan-imunisasi.index') }}" class="mb-4">
                <!-- Baris untuk Search -->
                <div class="row g-3 align-items-end mb-3">
                    <div class="col-md-8">
                        <label class="form-label small mb-1">Pencarian Umum</label>
                        <div class="input-group">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari berdasarkan jenis vaksin, lokasi, nakes, atau nama warga..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="input-group-text">
                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search'=> null]) }}" class="btn btn-outline-secondary ml-3" id="clear-search">Clear</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Baris untuk Filter Spesifik -->
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Nama Warga</label>
                        <input type="text"
                               name="nama_warga"
                               class="form-control"
                               placeholder="Cari nama warga..."
                               value="{{ request('nama_warga') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Jenis Vaksin</label>
                        <select name="jenis_vaksin" class="form-select">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisVaksinList as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis_vaksin') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Tanggal Mulai</label>
                        <input type="date"
                               name="tanggal_dari"
                               class="form-control"
                               value="{{ request('tanggal_dari') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small mb-1">Tanggal Akhir</label>
                        <input type="date"
                               name="tanggal_sampai"
                               class="form-control"
                               value="{{ request('tanggal_sampai') }}">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <div class="flex-fill">
                            <button type="submit" class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                        <div class="flex-fill">
                            <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-outline-secondary w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-undo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Warga</th>
                            <th>NIK</th>
                            <th>Jenis Vaksin</th>
                            <th width="120">Tanggal</th>
                            <th>Lokasi</th>
                            <th>Nakes</th>
                            <th>File</th>
                            <th width="200" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catatan as $key => $item)
                        <tr>
                            <td class="text-center">{{ ($catatan->currentPage() - 1) * $catatan->perPage() + $key + 1 }}</td>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->warga->nik ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->jenis_vaksin }}</span>
                            </td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->nakes }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->media->count() }} file</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.catatan-imunisasi.show', $item->imunisasi_id) }}"
                                       class="btn btn-sm btn-info d-flex align-items-center">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    <a href="{{ route('admin.catatan-imunisasi.edit', $item->imunisasi_id) }}"
                                       class="btn btn-sm btn-warning d-flex align-items-center">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.catatan-imunisasi.destroy', $item->imunisasi_id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center"
                                                onclick="return confirm('Yakin hapus data?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3"></i>
                                    <p class="mb-0">Tidak ada data ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $catatan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6c757d;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }

    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .btn-sm i {
        font-size: 0.8rem;
    }

    .input-group .btn-outline-secondary {
        margin-left: 10px;
    }
</style>
@endsection
