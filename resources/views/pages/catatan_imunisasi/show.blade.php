@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Detail Catatan Imunisasi</h2>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Catatan Imunisasi #{{ $catatanImunisasi->imunisasi_id }}</h5>
            <div>
                <a href="{{ route('admin.catatan-imunisasi.edit', $catatanImunisasi->imunisasi_id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.catatan-imunisasi.destroy', $catatanImunisasi->imunisasi_id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Warga</th>
                            <td>{{ $catatanImunisasi->warga->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $catatanImunisasi->warga->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Vaksin</th>
                            <td>{{ $catatanImunisasi->jenis_vaksin }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ date('d/m/Y', strtotime($catatanImunisasi->tanggal)) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Lokasi</th>
                            <td>{{ $catatanImunisasi->lokasi }}</td>
                        </tr>
                        <tr>
                            <th>Nama Tenaga Kesehatan</th>
                            <td>{{ $catatanImunisasi->nakes }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $catatanImunisasi->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui</th>
                            <td>{{ $catatanImunisasi->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('admin.catatan-imunisasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection