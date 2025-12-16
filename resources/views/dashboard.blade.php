@extends('layouts.admin.app')

@section('title', 'Dashboard Admin Kesehatan Desa')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1">Dashboard Kesehatan Desa</h2>
                <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name ?? 'Administrator' }}! 👋</p>
            </div>
            <div class="text-end">
                <small class="text-muted">{{ now()->translatedFormat('l, d F Y') }}</small>
            </div>
        </div>

        <!-- Slideshow Posyandu -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-images me-2"></i> Kegiatan Posyandu
                    </div>

                    <div class="card-body p-0">
                        <div id="posyanduCarousel" class="carousel slide" data-bs-ride="carousel">

                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#posyanduCarousel" data-bs-slide-to="0"
                                    class="active"></button>
                                <button type="button" data-bs-target="#posyanduCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#posyanduCarousel" data-bs-slide-to="2"></button>
                                <button type="button" data-bs-target="#posyanduCarousel" data-bs-slide-to="3"></button>
                            </div>

                            <!-- Slides -->
                            <div class="carousel-inner rounded-bottom">

                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/images/posyandu1.jpg') }}" class="d-block w-100"
                                        style="height:360px; object-fit:cover;" alt="Posyandu 1">
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/posyandu2.jpg') }}" class="d-block w-100"
                                        style="height:360px; object-fit:cover;" alt="Posyandu 2">
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/posyandu3.jpg') }}" class="d-block w-100"
                                        style="height:360px; object-fit:cover;" alt="Posyandu 3">
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/posyandu4.jpg') }}" class="d-block w-100"
                                        style="height:360px; object-fit:cover;" alt="Posyandu 4">
                                </div>

                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#posyanduCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#posyanduCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fw-bold text-primary">{{ number_format($stats['totalWarga']) }}</h4>
                                <p class="text-muted mb-0">Total Warga</p>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-people-fill text-primary fs-4"></i>
                            </div>
                        </div>
                        <small class="text-success">
                            <i class="bi bi-arrow-up-short"></i> +5.2% dari bulan lalu
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fw-bold text-success">{{ $stats['totalJadwal'] }}</h4>
                                <p class="text-muted mb-0">Jadwal Posyandu</p>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-calendar-check text-success fs-4"></i>
                            </div>
                        </div>
                        <small class="text-success">
                            <i class="bi bi-arrow-up-short"></i> +3 jadwal baru
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #6f42c1;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fw-bold text-purple">{{ $stats['kunjunganBulanIni'] }}</h4>
                                <p class="text-muted mb-0">Kunjungan Posyandu</p>
                            </div>
                            <div class="bg-purple bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-hospital text-purple fs-4"></i>
                            </div>
                        </div>
                        <small class="text-success">
                            <i class="bi bi-arrow-up-short"></i> +12% dari target
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #fd7e14;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="fw-bold text-warning">{{ $stats['jadwalHariIni'] }}</h4>
                                <p class="text-muted mb-0">Posyandu Hari Ini</p>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <small class="text-danger">
                            <i class="bi bi-exclamation-triangle"></i> Segera dilaksanakan
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Tables Section -->
        <div class="row">
            <!-- Data Warga Terbaru -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-people me-2"></i> Data Warga Terbaru</span>
                        <a href="{{ url('/admin/warga') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th>RT/RW</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wargaTerbaru as $warga)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($warga['nama']) }}&background=0d6efd&color=fff"
                                                        alt="{{ $warga['nama'] }}" class="rounded-circle me-2"
                                                        width="32" height="32">
                                                    <div>
                                                        <div class="fw-semibold">{{ $warga['nama'] }}</div>
                                                        <small class="text-muted">{{ $warga['jenis_kelamin'] }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $warga['usia'] }} thn</td>
                                            <td>{{ $warga['rt'] }}/{{ $warga['rw'] }}</td>
                                            <td>
                                                @if ($warga['status'] == 'Aktif')
                                                    <span class="badge bg-success">Aktif</span>
                                                @elseif($warga['status'] == 'Lansia')
                                                    <span class="badge bg-info">Lansia</span>
                                                @elseif($warga['status'] == 'Ibu Hamil')
                                                    <span class="badge bg-warning">Ibu Hamil</span>
                                                @elseif($warga['status'] == 'Balita')
                                                    <span class="badge bg-purple">Balita</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $warga['status'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Posyandu Mendatang -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-calendar-event me-2"></i> Jadwal Posyandu Mendatang</span>
                        <a href="{{ url('/admin/jadwal') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Posyandu & Tema</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalMendatang as $jadwal)
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <strong>{{ \Carbon\Carbon::parse($jadwal['tanggal'])->format('d/m') }}</strong>
                                                    <small
                                                        class="d-block text-muted">{{ \Carbon\Carbon::parse($jadwal['tanggal'])->format('D') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $jadwal['nama_posyandu'] }}</div>
                                                <small class="text-muted">{{ $jadwal['tema'] }}</small>
                                            </td>
                                            <td>
                                                <small>{{ Str::limit($jadwal['keterangan'], 30) ?: '-' }}</small>
                                            </td>
                                            <td>
                                                @if ($jadwal['status'] == 'hari_ini')
                                                    <span class="badge bg-danger">Hari Ini</span>
                                                @else
                                                    <span class="badge bg-info">Akan Datang</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats & Activities -->
        <div class="row">
            <!-- Quick Stats -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <i class="bi bi-graph-up me-2"></i> Statistik Cepat
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-3">
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <h4 class="text-warning mb-1">{{ $stats['pending'] ?? 8 }}</h4>
                                    <small class="text-muted">Pending</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3 bg-light">
                                    <h4 class="text-success mb-1">{{ $stats['selesai'] ?? 156 }}</h4>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3 bg-light">
                                    <h4 class="text-primary mb-1">{{ $stats['berjalan'] ?? 12 }}</h4>
                                    <small class="text-muted">Berjalan</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-3 bg-light">
                                    <h4 class="text-purple mb-1">{{ $stats['kepuasanWarga'] ?? 95 }}%</h4>
                                    <small class="text-muted">Kepuasan</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="bi bi-lightning me-2"></i> Quick Actions
                            </h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('jadwal.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
                                </a>
                                <a href="{{ url('/admin/warga/create') }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-person-plus me-1"></i> Tambah Warga
                                </a>
                                <a href="{{ route('admin.layanan-posyandu.create') }}"
                                    class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-hospital me-1"></i> Tambah Layanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-clock-history me-2"></i> Aktivitas Terkini</span>
                        <small>Update: {{ now()->format('H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach ($aktivitasTerkini as $activity)
                                <div class="timeline-item d-flex mb-3">
                                    <div class="timeline-icon me-3">
                                        <div class="bg-{{ $activity['color'] }} bg-opacity-10 rounded-circle p-2">
                                            <i class="bi {{ $activity['icon'] }} text-{{ $activity['color'] }}"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1 fw-semibold">{{ $activity['title'] }}</h6>
                                                <p class="mb-1 text-muted">{{ $activity['description'] }}</p>
                                            </div>
                                            <small class="text-muted">{{ $activity['time'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demographic Info -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-purple text-white">
                        <i class="bi bi-pie-chart me-2"></i> Informasi Demografis
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-primary mb-1">{{ $stats['rataRataUsia'] ?? 35 }}</h4>
                                    <small class="text-muted">Rata-rata Usia</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-success mb-1">{{ $stats['wargaAktif'] ?? 68 }}%</h4>
                                    <small class="text-muted">Warga Aktif</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-info mb-1">{{ $stats['persentaseLansia'] ?? 23 }}%</h4>
                                    <small class="text-muted">Lansia</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-warning mb-1">{{ $stats['persentaseIbuBalita'] ?? 9 }}%</h4>
                                    <small class="text-muted">Ibu Hamil & Balita</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Identitas Pengembang -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                        <div class="text-primary fw-bold">
                            <i class="bi bi-person-badge me-2"></i> Identitas Pengembang
                        </div>
                        <span class="badge bg-light text-dark">Developer</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-4 mb-md-0">
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('assets/images/pengembang.jpg') }}" alt="Foto Pengembang"
                                        class="rounded-circle img-thumbnail shadow"
                                        style="width: 180px; height: 180px; object-fit: cover;">
                                    <div
                                        class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border border-3 border-white">
                                        <i class="bi bi-check-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex align-items-center mb-2">
                                    <h4 class="fw-bold text-gradient-primary mb-0">Roujwa Tifaelfaira Nihallubna</h4>
                                    <span class="badge bg-success ms-3">Aktif</span>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bg-light rounded-circle p-2 me-3">
                                                <i class="bi bi-person-vcard text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">NIM</small>
                                                <strong>2457301127</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bg-light rounded-circle p-2 me-3">
                                                <i class="bi bi-book text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Program Studi</small>
                                                <strong>Sistem Informasi</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-light rounded-circle p-2 me-3">
                                        <i class="bi bi-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <strong>roujwa24si@mahasiswa.pcr.ac.id</strong>
                                    </div>
                                </div>

                                <div class="border-top pt-3">
                                    <h6 class="text-muted mb-3">Hubungi Saya:</h6>
                                    <div class="d-flex flex-wrap gap-3">
                                        <a href="mailto:roujwa24si@mahasiswa.pcr.ac.id"
                                            class="btn btn-primary btn-sm d-flex align-items-center px-3 py-2">
                                            <i class="bi bi-envelope me-2"></i> Email
                                        </a>
                                        <a href="http://linkedin.com/in/ai-raa-19210839a" target="_blank"
                                            class="btn btn-outline-primary btn-sm d-flex align-items-center px-3 py-2">
                                            <i class="bi bi-linkedin me-2"></i> LinkedIn
                                        </a>
                                        <a href="https://github.com/tifaelfaira" target="_blank"
                                            class="btn btn-outline-dark btn-sm d-flex align-items-center px-3 py-2">
                                            <i class="bi bi-github me-2"></i> GitHub
                                        </a>
                                        <a href="https://youtube.com/@roujwafaira?si=7ySPIfIZI8U8szz7" target="_blank"
                                            class="btn btn-outline-danger btn-sm d-flex align-items-center px-3 py-2">
                                            <i class="bi bi-youtube me-2"></i> YouTube
                                        </a>
                                        <a href="https://instagram.com/tifaa_.ya" target="_blank"
                                            class="btn btn-outline-warning btn-sm d-flex align-items-center px-3 py-2">
                                            <i class="bi bi-instagram me-2"></i> Instagram
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Hubungi pengembang untuk pertanyaan teknis atau masukan tentang aplikasi ini.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
