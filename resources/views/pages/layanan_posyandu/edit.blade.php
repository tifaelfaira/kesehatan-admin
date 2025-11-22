@extends('layouts.admin.app')

@section('title', 'Edit Layanan Posyandu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Layanan Posyandu
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Menampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terjadi kesalahan input:
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.layanan-posyandu.update', $layanan->layanan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Jadwal Posyandu -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jadwal Posyandu <span class="text-danger">*</span></label>
                            <select name="jadwal_id" class="form-select @error('jadwal_id') is-invalid @enderror" required>
                                <option value="">- Pilih Jadwal Posyandu -</option>
                                @foreach ($jadwal as $j)
                                    <option value="{{ $j->jadwal_id }}" 
                                        {{ old('jadwal_id', $layanan->jadwal_id) == $j->jadwal_id ? 'selected' : '' }}>
                                        {{ $j->nama_posyandu }} - 
                                        {{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }} - 
                                        {{ $j->tema }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jadwal_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilih Warga -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Warga <span class="text-danger">*</span></label>
                            <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                                <option value="">- Pilih Warga -</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->id }}"
                                        {{ old('warga_id', $layanan->warga_id) == $w->id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                        @if(!empty($w->jenis_kelamin))
                                            ({{ $w->jenis_kelamin }})
                                        @endif
                                        @if(!empty($w->umur) || !empty($w->tanggal_lahir))
                                            - {{ $w->umur ?? \Carbon\Carbon::parse($w->tanggal_lahir)->age }} th
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Berat Badan -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Berat Badan (kg) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" name="berat" class="form-control @error('berat') is-invalid @enderror" 
                                       value="{{ old('berat', $layanan->berat) }}" required>
                                @error('berat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tinggi Badan -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" name="tinggi" class="form-control @error('tinggi') is-invalid @enderror" 
                                       value="{{ old('tinggi', $layanan->tinggi) }}" required>
                                @error('tinggi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Vitamin -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Vitamin</label>
                            <input type="text" name="vitamin" class="form-control @error('vitamin') is-invalid @enderror" 
                                   value="{{ old('vitamin', $layanan->vitamin) }}">
                            @error('vitamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konseling -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konseling</label>
                            <textarea name="konseling" class="form-control @error('konseling') is-invalid @enderror" 
                                      rows="3">{{ old('konseling', $layanan->konseling) }}</textarea>
                            @error('konseling')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.layanan-posyandu.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection