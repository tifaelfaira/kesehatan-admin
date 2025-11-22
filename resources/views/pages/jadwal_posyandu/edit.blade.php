@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Edit Jadwal Posyandu</h2>

    <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Posyandu</label>
            <input type="text" name="nama_posyandu" value="{{ old('nama_posyandu', $jadwal->nama_posyandu) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tema</label>
            <input type="text" name="tema" value="{{ old('tema', $jadwal->tema) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Poster (URL)</label>
            <input type="text" name="poster" value="{{ old('poster', $jadwal->poster) }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection