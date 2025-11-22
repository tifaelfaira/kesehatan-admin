@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Daftar Jadwal Posyandu</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>  <!-- TAMBAH INI -->
                <th>Tanggal</th>
                <th>Nama Posyandu</th>
                <th>Tema</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>  <!-- TAMBAH INI -->
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->nama_posyandu }}</td>
                    <td>{{ $j->tema }}</td>
                    <td>{{ $j->keterangan }}</td>
                    <td>
                        <a href="{{ route('jadwal.edit', $j->jadwal_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $j->jadwal_id) }}" method="POST" class="d-inline">
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