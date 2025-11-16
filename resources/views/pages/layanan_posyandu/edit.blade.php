@extends('layouts.admin.app')

@section('title', 'Edit Layanan Posyandu')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Layanan Posyandu</h3>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.layanan-posyandu.update', $layanan->layanan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Jadwal -->
        <div class="mb-3">
            <label class="form-label">Jadwal</label>
            <select name="jadwal_id" class="form-select" required>
                <option value="">- Pilih Jadwal -</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->id }}" 
                        {{ old('jadwal_id', $layanan->jadwal_id) == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_kegiatan }} - {{ $j->tanggal }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Warga -->
        <div class="mb-3">
            <label class="form-label">Warga</label>
            <select name="warga_id" class="form-select" required>
                <option value="">- Pilih Warga -</option>
                @foreach ($warga as $w)
                    <option value="{{ $w->id }}"
                        {{ old('warga_id', $layanan->warga_id) == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Berat Badan -->
        <div class="mb-3">
            <label class="form-label">Berat Badan (kg)</label>
            <input type="number" step="0.1" name="berat" class="form-control" 
                   value="{{ old('berat', $layanan->berat) }}" required>
        </div>

        <!-- Tinggi Badan -->
        <div class="mb-3">
            <label class="form-label">Tinggi Badan (cm)</label>
            <input type="number" step="0.1" name="tinggi" class="form-control" 
                   value="{{ old('tinggi', $layanan->tinggi) }}" required>
        </div>

        <!-- Vitamin -->
        <div class="mb-3">
            <label class="form-label">Vitamin</label>
            <input type="text" name="vitamin" class="form-control" 
                   value="{{ old('vitamin', $layanan->vitamin) }}">
        </div>

        <!-- Konseling -->
        <div class="mb-3">
            <label class="form-label">Konseling</label>
            <textarea name="konseling" class="form-control">{{ old('konseling', $layanan->konseling) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.layanan-posyandu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
