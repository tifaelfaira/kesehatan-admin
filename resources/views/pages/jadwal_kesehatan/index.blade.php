@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Daftar Jadwal Kesehatan Desa</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $j)
                <tr>
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->nama_kegiatan }}</td>
                    <td>{{ $j->keterangan }}</td>
                    <td>{{ $j->lokasi }}</td>
                    <td>
                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
