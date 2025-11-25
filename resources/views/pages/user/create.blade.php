@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">
  <h4 class="mb-4">➕ Tambah User Baru</h4>

  <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 bg-white rounded">
    @csrf
    
    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-control" required>
        <option value="">Pilih Role</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
      </select>
      @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- Input Foto Profil --}}
    <div class="mb-3">
      <label for="profile_picture">Foto Profil</label>
      <input type="file" name="profile_picture" class="form-control">
      <small class="text-muted">Format: jpeg, png, jpg | Maksimal: 150MB</small>
      @error('profile_picture') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection