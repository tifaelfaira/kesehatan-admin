@extends('layouts.admin.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary">
      <i class="bi bi-people-fill"></i> Data Pelanggan
    </h4>
    <div>
      <span class="badge bg-success me-2">Total: {{ $pelanggan->total() }} Pelanggan</span>
      <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill"></i> Tambah Pelanggan
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Form Pencarian --}}
  <div class="card mb-4">
    <div class="card-header bg-light">
      <i class="bi bi-search"></i> Pencarian Data
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('pelanggan.index') }}" class="row g-3">
        <div class="col-md-8">
          <div class="input-group">
            <input type="text" name="search" class="form-control" 
                   value="{{ $search }}" 
                   placeholder="Cari nama atau email pelanggan..." 
                   aria-label="Search">
            <button type="submit" class="input-group-text">
              <i class="bi bi-search"></i>
            </button>
            @if($search)
              <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">
                Clear
              </a>
            @endif
          </div>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-arrow-clockwise"></i> Reset
          </a>
        </div>
      </form>
    </div>
  </div>

  {{-- Info Hasil Pencarian --}}
  @if($search)
    <div class="alert alert-info mb-3">
      <i class="bi bi-info-circle"></i> 
      Hasil pencarian untuk: <strong>"{{ $search }}"</strong>
      <span class="badge bg-primary ms-2">{{ $pelanggan->total() }} pelanggan ditemukan</span>
    </div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-semibold">
      <i class="bi bi-list-ul"></i> Daftar Pelanggan
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-primary text-center align-middle">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>File</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          @forelse($pelanggan as $index => $item)
            <tr>
              <td>{{ $pelanggan->firstItem() + $index }}</td>
              <td class="text-start">
                <i class="bi bi-person-circle text-primary"></i>
                {{ $item->nama }}
              </td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->telepon ?? '-' }}</td>
              <td class="text-start">
                <small>{{ Str::limit($item->alamat, 30) ?: '-' }}</small>
              </td>
              <td>
                <span class="badge bg-info">
                  <i class="bi bi-files"></i> {{ $item->files->count() }} file
                </span>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-muted py-4">
                <div class="text-center">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                  <p class="mt-2">Belum ada pelanggan terdaftar</p>
                  <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
                    Tambah Pelanggan Pertama
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Pagination --}}
  <div class="mt-3 d-flex justify-content-center">
    {{ $pelanggan->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection