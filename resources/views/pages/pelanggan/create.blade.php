@extends('layouts.admin.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container">
  <h4 class="mb-4">➕ Tambah Pelanggan</h4>

  <form action="{{ route('pelanggan.store') }}" method="POST" class="shadow-sm p-4 bg-white rounded">
    @csrf

    <div class="mb-3">
      <label>Nama Pelanggan</label>
      <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
      @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Telepon</label>
      <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
      @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
      @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection