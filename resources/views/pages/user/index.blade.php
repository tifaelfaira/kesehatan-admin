@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary">
      <i class="bi bi-person-lines-fill"></i> Data User
      <span class="badge bg-info text-dark ms-2">Admin Panel</span>
    </h4>
    <div>
      <span class="badge bg-success me-2">Total: {{ $users->total() }} User</span>
      <a href="/admin/user/create" class="btn btn-primary">
        <i class="bi bi-person-plus-fill"></i> Tambah User
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Form Filter & Search --}}
  <div class="card mb-4">
    <div class="card-header bg-light">
      <i class="bi bi-funnel"></i> Filter & Pencarian Data
    </div>
    <div class="card-body">
      <form method="GET" action="/admin/user" class="row g-3">
        {{-- Filter Role --}}
        <div class="col-md-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
          </select>
        </div>

        {{-- Search --}}
        <div class="col-md-6">
          <label for="search" class="form-label">Pencarian</label>
          <div class="input-group">
            <input type="text" name="search" class="form-control" 
                   value="{{ request('search') }}" 
                   placeholder="Cari nama atau email..." 
                   aria-label="Search">
            <button type="submit" class="input-group-text" id="basic-addon2">
              <i class="bi bi-search"></i>
            </button>
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
        <div class="col-md-3 d-flex align-items-end">
          <a href="/admin/user" class="btn btn-outline-secondary w-100">
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
      <span class="badge bg-primary ms-2">{{ $users->total() }} user ditemukan</span>
    </div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-semibold">
      <i class="bi bi-list-ul"></i> Daftar Pengguna
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-primary text-center align-middle">
          <tr>
            <th>No</th>
            <th>Foto</th> <!-- KOLOM BARU UNTUK FOTO -->
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          @forelse($users as $index => $user)
            <tr>
              <td>{{ $users->firstItem() + $index }}</td>
              <td>
                @if($user->profile_picture)
                  <img src="{{ Storage::url($user->profile_picture) }}" width="40" height="40" class="rounded-circle object-fit-cover">
                @else
                  <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:40px;height:40px;">
                    <span class="text-white fw-bold">{{ substr($user->name, 0, 1) }}</span>
                  </div>
                @endif
              </td>
              <td>
                <i class="bi bi-person-circle text-primary"></i>
                {{ $user->name }}
              </td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->role == 'admin')
                  <span class="badge bg-primary"><i class="bi bi-shield-lock"></i> Admin</span>
                @else
                  <span class="badge bg-success"><i class="bi bi-person"></i> Guest</span>
                @endif
              </td>
              <td>
                <small class="text-muted">
                  {{ $user->created_at->format('d/m/Y') }}
                </small>
              </td>
              <td>
                <div class="btn-group" role="group">
                  <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="/admin/user/{{ $user->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-muted py-4"> <!-- COLSPAN JADI 7 -->
                <div class="text-center">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                  <p class="mt-2">Belum ada pengguna terdaftar</p>
                  <a href="/admin/user/create" class="btn btn-primary btn-sm">
                    Tambah User Pertama
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
    {{ $users->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection