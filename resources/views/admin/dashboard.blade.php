@extends('layouts.app')

@section('title', 'Dashboard Admin Kesehatan Desa')

@section('content')
<div class="container">
  <div class="text-center mb-4">
    <h2 class="fw-bold text-primary">Selamat Datang, Administrator 🌤️</h2>
    <p class="text-muted">Berikut ringkasan data kegiatan kesehatan desa bulan ini:</p>
  </div>

  <!-- Statistik -->
  <div class="row justify-content-center mb-4">
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">
          <h4 class="text-primary">{{ $totalWarga ?? 12 }}</h4>
          <p class="text-muted mb-0">Jadwal Kegiatan</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">
          <h4 class="text-primary">{{ $totalMedis ?? 8 }}</h4>
          <p class="text-muted mb-0">Tenaga Medis Aktif</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">
          <h4 class="text-primary">{{ $laporanBaru ?? 3 }}</h4>
          <p class="text-muted mb-0">Laporan Baru</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Jadwal Kesehatan Terdekat -->
  <div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-header text-white fw-semibold" style="background-color:#5ea8ff;">
      <i class="bi bi-calendar-event me-2"></i> Jadwal Kesehatan Terdekat
    </div>
    <div class="card-body p-0">
      <table class="table mb-0 text-center align-middle">
        <thead style="background:#e8f2ff;">
          <tr>
            <th>Tanggal</th>
            <th>Kegiatan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-10-05</td>
            <td>Pemeriksaan Balita & Imunisasi</td>
            <td>Cek berat badan, tinggi, dan imunisasi campak.</td>
          </tr>
          <tr>
            <td>2025-10-12</td>
            <td>Penyuluhan Gizi Ibu Hamil</td>
            <td>Materi gizi seimbang untuk ibu hamil.</td>
          </tr>
          <tr>
            <td>2025-10-19</td>
            <td>Pemeriksaan Lansia</td>
            <td>Pemeriksaan tekanan darah dan gula darah.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
