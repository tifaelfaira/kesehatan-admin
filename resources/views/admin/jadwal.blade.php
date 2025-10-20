@extends('layouts.main')

@section('content')
<div class="container mt-4">

  {{-- 🔹 Judul halaman --}}
  <h4 class="mb-3">📅 Jadwal Kegiatan Kesehatan</h4>

  {{-- 🔹 Deskripsi singkat --}}
  <p class="text-muted">
    Berikut ini adalah daftar jadwal kegiatan posyandu dan pelayanan kesehatan yang sudah terdaftar.
  </p>

  {{-- 🔹 Tabel Jadwal Contoh --}}
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Tempat</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Pemeriksaan Balita</td>
            <td>22 Oktober 2025</td>
            <td>08:00 - 10:00</td>
            <td>Posyandu Melati</td>
            <td>Wajib membawa KMS</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Imunisasi Bulanan</td>
            <td>25 Oktober 2025</td>
            <td>09:00 - 11:00</td>
            <td>Puskesmas Sehat Sentosa</td>
            <td>Gratis untuk semua warga</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Penyuluhan Gizi</td>
            <td>28 Oktober 2025</td>
            <td>13:00 - 15:00</td>
            <td>Aula Kelurahan</td>
            <td>Pembicara: dr. Rina, Sp.GK</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  {{-- 🔹 Tombol tambah (opsional untuk nanti dihubungkan ke CRUD Jadwal) --}}
  <div class="text-end mt-3">
    <a href="#" class="btn btn-outline-success disabled">+ Tambah Jadwal (coming soon)</a>
  </div>

</div>
@endsection
