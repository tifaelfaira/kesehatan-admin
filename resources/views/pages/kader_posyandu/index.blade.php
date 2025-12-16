@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold"><i class="bi bi-people"></i> Kader Posyandu</h2>
        <a href="{{ route('admin.kader-posyandu.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kader
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kader</th>
                        <th>Posyandu</th>
                        <th>Peran</th>
                        <th>Masa Tugas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($kader as $i => $item)
                    <tr>
                        <td>{{ $kader->firstItem() + $i }}</td>
                        <td>{{ $item->warga->nama }}</td>
                        <td>{{ $item->posyandu->nama }}</td>
                        <td>{{ $item->peran }}</td>
                        <td>{{ $item->mulai_tugas }} - {{ $item->akhir_tugas ?? 'Sekarang' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.kader-posyandu.edit', $item->kader_id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.kader-posyandu.destroy', $item->kader_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $kader->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection
