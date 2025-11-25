@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
<div class="container">
  <h4 class="mb-4">✏️ Edit User</h4>

  <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Password (Opsional)</label>
      <input type="password" name="password" class="form-control">
      <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
    </div>

    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-control">
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="guest" {{ old('role', $user->role) == 'guest' ? 'selected' : '' }}>Guest</option>
      </select>
      @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- TAMBAHAN: Input Foto Profil --}}
    <div class="mb-3">
      <label for="profile_picture">Foto Profil</label>
      <input type="file" name="profile_picture" class="form-control">
      @if($user->profile_picture)
        <div class="mt-2">
          <img src="{{ Storage::url($user->profile_picture) }}" width="100" class="img-thumbnail">
          <p class="text-muted small mt-1">Foto profil saat ini</p>
        </div>
      @endif
      @error('profile_picture') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection