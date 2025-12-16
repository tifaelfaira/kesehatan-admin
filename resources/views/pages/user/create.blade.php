@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">

    <h4 class="mb-3 fw-bold text-primary">
        <i class="bi bi-person-plus-fill"></i> Tambah User
    </h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                               class="form-control"
                               value="{{ old('username') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Foto Profil</label>
                        <input type="file"
                               name="photo"
                               class="form-control"
                               accept="image/*">
                        <small class="text-muted">
                            Jika tidak upload, otomatis pakai foto default
                        </small>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('user.index') }}"
                       class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
