@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center" style="width: 80%; max-width: 900px;">
        
        <h4 class="fw-bold mb-4">🏠 Dashboard Admin Kesehatan</h4>

        <div class="alert alert-primary text-start shadow-sm" role="alert">
            Selamat datang di <strong>Dashboard Kesehatan Admin!</strong> Di sini kamu bisa mengelola data kesehatan seperti posyandu, warga, jadwal, dan lainnya.
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0" style="background-color: #4B49AC; color: #fff;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Total Data Kesehatan</h5>
                        <h2 class="mt-3">0</h2>
                        <p class="mb-0">Jumlah posyandu / fasilitas yang terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0" style="background-color: #00BCD4; color: #fff;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Data Terbaru</h5>
                        <p class="mt-3 mb-0">Belum ada data kesehatan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0" style="background-color: #FFA726; color: #fff;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Admin Info</h5>
                        <p class="mt-3 mb-0">Login sebagai <strong>Admin</strong></p>
                        <small>Tanggal: {{ now()->format('d M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('kesehatan.index') }}" class="btn btn-outline-primary">
                Kelola Data Kesehatan →
            </a>
        </div>
    </div>
</div>
@endsection
