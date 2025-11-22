@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Tambah Jadwal Posyandu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Posyandu</label>
            <input type="text" name="nama_posyandu" value="{{ old('nama_posyandu') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tema</label>
            <input type="text" name="tema" value="{{ old('tema') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Poster (URL)</label>
            <input type="text" name="poster" value="{{ old('poster') }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection