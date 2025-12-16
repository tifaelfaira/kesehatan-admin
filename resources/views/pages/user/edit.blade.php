@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
<div class="container">

    <h4 class="mb-3 fw-bold text-primary">
        <i class="bi bi-pencil"></i> Edit User
    </h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="text-center mb-3">
                <img src="{{ $user->profile_photo_url }}"
                     class="rounded-circle"
                     style="width:150px;height:150px;object-fit:cover;">
            </div>

            <form action="{{ route('user.update', $user->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username"
                               class="form-control"
                               value="{{ $user->username }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="{{ $user->email }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="super_admin" {{ $user->role=='super_admin'?'selected':'' }}>Super Admin</option>
                            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                            <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Foto Profil</label>
                    <input type="file"
                           name="photo"
                           class="form-control"
                           accept="image/*">
                </div>

                <div class="text-end">
                    <a href="{{ route('user.index') }}"
                       class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
