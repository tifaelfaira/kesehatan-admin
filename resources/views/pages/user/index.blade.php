@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-person-lines-fill"></i> Data User
        </h4>
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i> Tambah User
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $user->profile_photo_url }}"
                                     class="rounded-circle"
                                     style="width:40px;height:40px;object-fit:cover;">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ ucfirst(str_replace('_',' ', $user->role)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('user.show', $user->id) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('user.edit', $user->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus user ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">
                                Belum ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
