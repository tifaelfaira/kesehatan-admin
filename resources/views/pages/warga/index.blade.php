@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Warga</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>JK</th>
                <th>Umur</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($warga as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->umur }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    <a href="{{ route('warga.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('warga.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data warga ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada data warga.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
