@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Detail Posyandu</h2>

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $posyandu->nama }}</h5>
            <div>
                <a href="{{ route('admin.posyandu.edit', $posyandu->posyandu_id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.posyandu.destroy', $posyandu->posyandu_id) }}" method="POST" style="display: inline;">
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
                            <th width="40%">Nama Posyandu</th>
                            <td>{{ $posyandu->nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $posyandu->alamat }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>{{ $posyandu->rt }}/{{ $posyandu->rw }}</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ $posyandu->kontak }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Dibuat</th>
                            <td>{{ $posyandu->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diperbarui</th>
                            <td>{{ $posyandu->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('admin.posyandu.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection