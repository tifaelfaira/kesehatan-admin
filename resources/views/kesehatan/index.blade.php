@extends('layouts.main')

@section('content')
<div class="container mt-4">

  {{-- 🔹 Judul halaman --}}
  <h4 class="mb-3">📋 Data Kesehatan</h4>

  {{-- 🔹 Notifikasi sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- 🔹 Notifikasi error --}}
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- 🔹 Tombol tambah data --}}
  <a href="{{ route('kesehatan.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

  {{-- 🔹 Tabel data --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
            <th>Kontak</th>
            <th>Foto</th>
            <th class="text-center" style="width: 160px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $item)
          <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->rt }}</td>
            <td>{{ $item->rw }}</td>
            <td>{{ $item->kontak }}</td>
            <td>
              @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" alt="foto" width="60" class="rounded">
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
            <td class="text-center">
              <a href="{{ route('kesehatan.edit', $item->kesehatan_id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('kesehatan.destroy', $item->kesehatan_id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted">Belum ada data kesehatan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
