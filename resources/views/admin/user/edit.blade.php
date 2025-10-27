@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="container">
  <h4 class="mb-4">✏️ Edit User</h4>

  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="shadow-sm p-4 bg-white rounded">
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

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
