@extends('layouts.admin.app')

@section('title', 'Data Layanan Posyandu')

@section('content')
<div class="container py-4">

    {{-- Header dan tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Data Layanan Posyandu</h3>
        <a href="{{ route('admin.layanan-posyandu.create') }}" class="btn btn-primary">
            + Tambah Layanan
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel data --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Warga</th>
                        <th>Jadwal</th>
                        <th>Berat (kg)</th>
                        <th>Tinggi (cm)</th>
                        <th>Vitamin</th>
                        <th>Konseling</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $row)
                        <tr>
                            {{-- Nomor urut --}}
                            <td class="text-center">{{ $data->firstItem() + $i }}</td>

                            {{-- Nama warga, aman jika null --}}
                            <td>{{ $row->warga->nama ?? 'Tidak Terdaftar' }}</td>

                            {{-- Nama jadwal, aman jika null --}}
                            <td>{{ $row->jadwal->nama_kegiatan ?? 'Tidak Ada Jadwal' }}</td>

                            <td>{{ $row->berat }} kg</td>
                            <td>{{ $row->tinggi }} cm</td>
                            <td>{{ $row->vitamin }}</td>
                            <td>{{ $row->konseling }}</td>

                            {{-- Aksi edit & hapus --}}
                            <td class="text-center">
                                {{-- Edit --}}
                                <a href="{{ route('admin.layanan-posyandu.edit', $row->layanan_id) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.layanan-posyandu.destroy', $row->layanan_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">
                                <em>Belum ada data layanan.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $data->links() }}
    </div>

</div>
@endsection
