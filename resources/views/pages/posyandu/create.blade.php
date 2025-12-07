@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Tambah Posyandu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posyandu.store') }}" method="POST">
        @csrf
        
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Posyandu <span class="text-danger">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rt" class="form-label">RT</label>
                            <input type="text" name="rt" value="{{ old('rt') }}" class="form-control" maxlength="5">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rw" class="form-label">RW</label>
                            <input type="text" name="rw" value="{{ old('rw') }}" class="form-control" maxlength="5">
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan Data
            </button>
            <a href="{{ route('admin.posyandu.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </form>
</div>
@endsection