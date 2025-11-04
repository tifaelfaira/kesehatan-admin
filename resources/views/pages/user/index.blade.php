@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary">
      <i class="bi bi-person-lines-fill"></i> Data User
      <span class="badge bg-info text-dark ms-2">Admin Panel</span>
    </h4>
    <a href="{{ route('user.create') }}" class="btn btn-primary">
      <i class="bi bi-person-plus-fill"></i> Tambah User
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
      <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          @forelse($users as $index => $user)
            <tr>
              <td>{{ $index + 1 }}</td>
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
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-muted">Belum ada pengguna terdaftar</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
