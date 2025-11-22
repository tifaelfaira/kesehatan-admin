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
      <a href="{{ route('user.create') }}" class="btn btn-primary">
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

  {{-- TAMBAH INI: Form Filter --}}
  <div class="card mb-4">
    <div class="card-header bg-light">
      <i class="bi bi-funnel"></i> Filter Data
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('user.index') }}" class="row g-3">
        {{-- Filter Role --}}
        <div class="col-md-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
          </select>
        </div>

        {{-- Tombol Reset --}}
        <div class="col-md-3 d-flex align-items-end">
          <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i> Reset Filter
          </a>
        </div>
      </form>
    </div>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-semibold">
      <i class="bi bi-list-ul"></i> Daftar Pengguna
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-primary text-center align-middle">
          <tr>
            <th>No</th>
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
                  <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
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
              <td colspan="6" class="text-muted py-4">
                <div class="text-center">
                  <i class="bi bi-people" style="font-size: 3rem;"></i>
                  <p class="mt-2">Belum ada pengguna terdaftar</p>
                  <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
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