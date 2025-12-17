@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-pencil-square"></i> Edit Kader Posyandu
        </h2>
        <a href="{{ route('admin.kader-posyandu.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kader-posyandu.update', $kader->kader_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-person-gear"></i> Edit Data Kader
                </h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Posyandu <span class="text-danger">*</span></label>
                    <select name="posyandu_id" class="form-select" required>
                        @foreach($posyandu as $item)
                            <option value="{{ $item->posyandu_id }}"
                                {{ old('posyandu_id', $kader->posyandu_id) == $item->posyandu_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warga <span class="text-danger">*</span></label>
                    <select name="warga_id" class="form-select" required>
                        @foreach($warga as $item)
                            <option value="{{ $item->id }}"
                                {{ old('warga_id', $kader->warga_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Peran <span class="text-danger">*</span></label>
                    <input type="text"
                           name="peran"
                           class="form-control"
                           value="{{ old('peran', $kader->peran) }}"
                           required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mulai Tugas <span class="text-danger">*</span></label>
                        <input type="date"
                               name="mulai_tugas"
                               class="form-control"
                               value="{{ old('mulai_tugas', $kader->mulai_tugas) }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Akhir Tugas</label>
                        <input type="date"
                               name="akhir_tugas"
                               class="form-control"
                               value="{{ old('akhir_tugas', $kader->akhir_tugas) }}">
                    </div>
                </div>
            </div>

            <div class="card-footer text-end bg-light">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
