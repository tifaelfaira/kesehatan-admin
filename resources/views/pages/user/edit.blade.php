@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
<div class="container">
  <h4 class="mb-4">✏️ Edit User</h4>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="/admin/user/{{ $user->id }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-control" required>
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="guest" {{ old('role', $user->role) == 'guest' ? 'selected' : '' }}>Guest</option>
      </select>
      @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Password (Opsional)</label>
      <input type="password" name="password" class="form-control">
      <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="/admin/user" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection