@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">
  <h4 class="mb-4">➕ Tambah User Baru</h4>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="/admin/user" method="POST" class="shadow-sm p-4 bg-white rounded">
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
      <label>Role</label>
      <select name="role" class="form-control" required>
        <option value="">Pilih Role</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
      </select>
      @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- HAPUS: Bagian input Foto Profil --}}

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/admin/user" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection