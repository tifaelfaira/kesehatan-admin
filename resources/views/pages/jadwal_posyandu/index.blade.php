@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Daftar Jadwal Posyandu</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
        <span class="badge bg-success">Total: {{ $jadwal->total() }} Data</span>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Posyandu</th>
                <th>Tema</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $index => $j)
                <tr>
                    {{-- Nomor urut dengan pagination --}}
                    <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $j->nama_posyandu }}</td>
                    <td>{{ $j->tema }}</td>
                    <td>{{ $j->keterangan ?: '-' }}</td>
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

    {{-- TAMBAH PAGINATION DI SINI --}}
    <div class="mt-3">
        {{ $jadwal->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection