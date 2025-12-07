@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Tambah Catatan Imunisasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.catatan-imunisasi.store') }}" method="POST">
        @csrf
        
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="warga_id" class="form-label">Warga <span class="text-danger">*</span></label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">Pilih Warga</option>
                        @foreach($warga as $item)
                            <option value="{{ $item->id }}" {{ old('warga_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }} (NIK: {{ $item->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="jenis_vaksin" class="form-label">Jenis Vaksin <span class="text-danger">*</span></label>
                    <input type="text" name="jenis_vaksin" value="{{ old('jenis_vaksin') }}" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="nakes" class="form-label">Nama Tenaga Kesehatan</label>
                    <input type="text" name="nakes" value="{{ old('nakes') }}" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection