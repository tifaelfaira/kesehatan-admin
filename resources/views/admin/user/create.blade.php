@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<div class="container">
  <h4 class="mb-4">➕ Tambah User Baru</h4>

  <form action="{{ route('admin.users.store') }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf
    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}">
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control">
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
