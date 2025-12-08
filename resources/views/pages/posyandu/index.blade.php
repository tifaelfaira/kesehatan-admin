@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-houses"></i> Data Posyandu
        </h2>
        <div>
            <a href="{{ route('admin.posyandu.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Posyandu
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter & Search --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <i class="bi bi-funnel"></i> Filter & Pencarian
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.posyandu.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nama Posyandu</label>
                    <input type="text" 
                           name="nama" 
                           class="form-control" 
                           placeholder="Cari nama posyandu..."
                           value="{{ request('nama') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Alamat</label>
                    <input type="text" 
                           name="alamat" 
                           class="form-control" 
                           placeholder="Cari alamat..."
                           value="{{ request('alamat') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.posyandu.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Hasil --}}
    @if(request()->anyFilled(['nama', 'alamat']))
        <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle"></i> 
            Hasil pencarian untuk: 
            @if(request('nama')) <strong>Nama: "{{ request('nama') }}"</strong> @endif
            @if(request('alamat')) <strong>Alamat: "{{ request('alamat') }}"</strong> @endif
            <span class="badge bg-primary ms-2">{{ $posyandu->total() }} data ditemukan</span>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-list-ul"></i> Daftar Posyandu
            <span class="badge bg-light text-dark ms-2">{{ $posyandu->total() }} data</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Foto</th>
                            <th>Nama Posyandu</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kontak</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posyandu as $key => $item)
                        <tr>
                            <td class="text-center">{{ ($posyandu->currentPage() - 1) * $posyandu->perPage() + $key + 1 }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" 
                                         alt="{{ $item->nama }}" 
                                         class="rounded" 
                                         width="50" 
                                         height="50"
                                         style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" 
                                         style="width:50px; height:50px;">
                                        <i class="bi bi-house"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium">{{ $item->nama }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->alamat, 40) ?: '-' }}</td>
                            <td>
                                @if($item->rt && $item->rw)
                                    {{ $item->rt }}/{{ $item->rw }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->kontak ?: '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.posyandu.show', $item->posyandu_id) }}" 
                                       class="btn btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.posyandu.edit', $item->posyandu_id) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.posyandu.destroy', $item->posyandu_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Hapus posyandu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-house-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-2 text-muted">Belum ada data posyandu</p>
                                <a href="{{ route('admin.posyandu.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Posyandu Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Pagination --}}
        @if($posyandu->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $posyandu->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection