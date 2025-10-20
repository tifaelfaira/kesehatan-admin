@extends('layouts.main')

@section('content')
<div class="container mt-4">

  {{-- 🔹 Judul halaman --}}
  <h4 class="mb-3">➕ Tambah Data Kesehatan</h4>

  {{-- 🔹 Notifikasi error validasi --}}
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Terjadi kesalahan!</strong>
      <ul class="mb-0 mt-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- 🔹 Form tambah data --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('kesehatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama posyandu">
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Masukkan alamat lengkap">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">RT</label>
            <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="RT">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">RW</label>
            <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="RW">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Kontak</label>
          <input type="text" name="kontak" class="form-control" value="{{ old('kontak') }}" placeholder="Masukkan nomor kontak">
        </div>

        <div class="mb-3">
          <label class="form-label">Foto</label>
          <input type="file" name="foto" class="form-control">
          <small class="text-muted">Format: JPG, JPEG, PNG — Max 2MB</small>
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('kesehatan.index') }}" class="btn btn-secondary">← Kembali</a>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection
