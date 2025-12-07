@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Catatan Imunisasi</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('admin.catatan-imunisasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Catatan
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>NIK</th>
                            <th>Jenis Vaksin</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Nakes</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catatan as $key => $item)
                        <tr>
                            <td>{{ ($catatan->currentPage() - 1) * $catatan->perPage() + $key + 1 }}</td>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->warga->nik ?? '-' }}</td>
                            <td>{{ $item->jenis_vaksin }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->nakes }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.catatan-imunisasi.show', $item->imunisasi_id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.catatan-imunisasi.edit', $item->imunisasi_id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.catatan-imunisasi.destroy', $item->imunisasi_id) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin hapus data?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- TAMBAHKAN PAGINATION BOOTSTRAP 5 -->
            <div class="mt-3">
                {{ $catatan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection