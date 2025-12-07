@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Data Posyandu</h2>
    
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
            <a href="{{ route('admin.posyandu.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Posyandu
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <!-- FORM FILTER -->
                <form method="GET" action="{{ route('admin.posyandu.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" 
                                       name="nama" 
                                       class="form-control" 
                                       placeholder="Cari nama posyandu..."
                                       value="{{ request('nama') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" 
                                       name="alamat" 
                                       class="form-control" 
                                       placeholder="Cari alamat..."
                                       value="{{ request('alamat') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.posyandu.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Posyandu</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posyandu as $key => $item)
                        <tr>
                            <td>{{ ($posyandu->currentPage() - 1) * $posyandu->perPage() + $key + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ Str::limit($item->alamat, 50) }}</td>
                            <td>{{ $item->rt }}/{{ $item->rw }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.posyandu.show', $item->posyandu_id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.posyandu.edit', $item->posyandu_id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.posyandu.destroy', $item->posyandu_id) }}" 
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
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $posyandu->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection