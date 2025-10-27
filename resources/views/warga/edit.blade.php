@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Data Warga</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('warga.update', $warga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" value="{{ old('nik', $warga->nik) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="">- Pilih -</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin)=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin)=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" value="{{ old('umur', $warga->umur) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">RT/RW</label>
            <input type="text" name="rt_rw" value="{{ old('rt_rw', $warga->rt_rw) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $warga->alamat) }}</textarea>
        </div>

        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
