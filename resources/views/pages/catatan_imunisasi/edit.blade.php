@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Edit Catatan Imunisasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catatan-imunisasi.update', $catatanImunisasi->imunisasi_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="warga_id" class="form-label">Warga <span class="text-danger">*</span></label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">Pilih Warga</option>
                        @foreach($warga as $item)
                            <option value="{{ $item->id }}" {{ old('warga_id', $catatanImunisasi->warga_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }} (NIK: {{ $item->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="jenis_vaksin" class="form-label">Jenis Vaksin <span class="text-danger">*</span></label>
                    <input type="text" name="jenis_vaksin" value="{{ old('jenis_vaksin', $catatanImunisasi->jenis_vaksin) }}" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $catatanImunisasi->tanggal) }}" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $catatanImunisasi->lokasi) }}" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="nakes" class="form-label">Nama Tenaga Kesehatan</label>
                    <input type="text" name="nakes" value="{{ old('nakes', $catatanImunisasi->nakes) }}" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection