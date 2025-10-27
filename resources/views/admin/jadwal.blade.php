<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>@yield('title', 'Breeze Admin')</title>
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>

        </div>
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="assets/images/faces/face1.jpg" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2">Henry Klein</span>
                <span class="font-weight-normal">$8,753.00</span>
              </div>
              <span class="badge badge-danger text-white ml-3 rounded">3</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          

          <!-- SIDEBAR UNTUK JADWALLLL -->

          <li class="nav-item">
            <a class="nav-link" href="jadwal">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Jadwal</span>
            </a>
          


          <li class="nav-item">
            <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
          <li class="nav-item sidebar-actions">
            <div class="nav-link">
              <div class="mt-4">
                <div class="border-none">
                  <p class="text-black">Notification</p>
                </div>
                <ul class="mt-4 pl-0">
                  <li>Sign Out</li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      
        
        

    <!-- TAMBAHKAN DISINI JADWAL JDAWAL YANG LEBIH BANYAKNYA -->

<div class="main-panel">
  <div class="content-wrapper pastel-container">

    <!-- HEADER -->
    <div class="pastel-header">
      📅 Daftar Jadwal Kegiatan Kesehatan Desa
    </div>

    <!-- CARD KONTEN -->
    <div class="card-content">
      <h1>Jadwal Kesehatan Bulan Oktober 2025</h1>
      <p>Berikut data lengkap kegiatan pelayanan kesehatan, penyuluhan, dan pemeriksaan masyarakat di wilayah Desa Sehat.</p>

      <!-- TABEL -->
      <div class="table-wrapper">
        <table class="pastel-table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Kegiatan</th>
              <th>Keterangan</th>
              <th>Lokasi</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>2025-10-02</td><td>Pemeriksaan Ibu Hamil</td><td>Cek tekanan darah & detak jantung janin</td><td>Posyandu Melati</td></tr>
            <tr><td>2025-10-05</td><td>Pemeriksaan Balita & Imunisasi</td><td>Cek berat badan, tinggi, dan imunisasi campak</td><td>Balai Desa</td></tr>
            <tr><td>2025-10-08</td><td>Pelatihan Kader Posyandu</td><td>Pembekalan tentang gizi & tumbuh kembang anak</td><td>Puskesmas Sungai Lestari</td></tr>
            <tr><td>2025-10-10</td><td>Pemeriksaan Gigi Anak Sekolah</td><td>Penyuluhan dan pemeriksaan rutin SD</td><td>SD Negeri 1 Riau</td></tr>
            <tr><td>2025-10-12</td><td>Penyuluhan Gizi Ibu Hamil</td><td>Materi tentang pentingnya gizi seimbang</td><td>Gedung Serbaguna</td></tr>
            <tr><td>2025-10-15</td><td>Pemeriksaan Lansia</td><td>Cek tekanan darah, gula darah, kolesterol</td><td>Posyandu Sehat Bahagia</td></tr>
            <tr><td>2025-10-17</td><td>Penyemprotan Sarang Nyamuk</td><td>Fogging untuk pencegahan DBD</td><td>Dusun Mekar Jaya</td></tr>
            <tr><td>2025-10-19</td><td>Senam Sehat Bersama</td><td>Senam pagi bersama masyarakat</td><td>Lapangan Desa</td></tr>
            <tr><td>2025-10-21</td><td>Pemeriksaan Kolesterol & Gula Darah</td><td>Cek kesehatan rutin warga</td><td>Puskesmas Utama</td></tr>
            <tr><td>2025-10-23</td><td>Penyuluhan Bahaya Merokok</td><td>Sosialisasi hidup sehat tanpa rokok</td><td>Balai Warga RT 05</td></tr>
            <tr><td>2025-10-26</td><td>Pemberian Vitamin A untuk Balita</td><td>Program gizi anak usia 1–5 tahun</td><td>Posyandu Mawar</td></tr>
            <tr><td>2025-10-28</td><td>Donor Darah Sukarela</td><td>Bekerja sama dengan PMI setempat</td><td>Balai Kecamatan</td></tr>
            <tr><td>2025-10-30</td><td>Pemeriksaan Ibu Menyusui</td><td>Konsultasi & pemeriksaan laktasi</td><td>Puskesmas Desa Sehat</td></tr>
          </tbody>
        </table>
      </div>

      <!-- TOMBOL -->
      <div class="action-buttons">
        <a href="#" class="btn">📄 Cetak Laporan</a>
        <a href="#" class="btn">➕ Tambah Jadwal</a>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="pastel-footer">
      © {{ date('Y') }} Sistem Kesehatan Desa — Tetap Sehat 💙
    </div>

  </div>
</div>

<!-- ===================== STYLE ===================== -->
<style>
  html, body {
    margin: 0;
    padding: 0;
    background: linear-gradient(180deg, #d8eaff 0%, #f5faff 100%);
    overflow-x: hidden;
  }

  /* PERBAIKAN UTAMA: hilangkan jarak dari layout Breeze */
  .container-scroller, .page-body-wrapper, .main-panel, .content-wrapper {
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
  }

  .content-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  /* KONTEN UTAMA */
  .pastel-container {
    width: 100%;
    min-height: 100vh;
    padding: 100px 40px 60px 40px;
    box-sizing: border-box;
    animation: fadeIn 1s ease-in;
    background: linear-gradient(180deg, #d8eaff 0%, #f5faff 100%);
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* HEADER */
  .pastel-header {
    background: linear-gradient(135deg, #69b9ff, #9dd2ff);
    color: white;
    padding: 25px 10px;
    text-align: center;
    font-size: 1.4em;
    font-weight: 600;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 1100px;
    margin-bottom: 25px;
  }

  /* KARTU KONTEN */
  .card-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(120,180,255,0.2);
    padding: 40px;
    width: 100%;
    max-width: 1100px;
    box-sizing: border-box;
  }

  /* TABEL */
  .pastel-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95em;
    border-radius: 10px;
    overflow: hidden;
  }

  .pastel-table thead {
    background: linear-gradient(135deg, #69b9ff, #9dd2ff);
    color: white;
  }

  .pastel-table th, .pastel-table td {
    padding: 14px 18px;
    border-bottom: 1px solid #e3eefc;
    text-align: center;
  }

  .pastel-table tbody tr:nth-child(even) {
    background-color: #f5faff;
  }

  .pastel-table tbody tr:hover {
    background-color: #e9f4ff;
    transition: 0.3s;
  }

  /* TOMBOL */
  .action-buttons {
    text-align: center;
    margin-top: 30px;
  }

  .btn {
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #5ea8ff, #8ac8ff);
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin: 8px;
    display: inline-block;
  }

  .btn:hover {
    background: linear-gradient(135deg, #4e9eff, #78bfff);
    transform: translateY(-3px);
  }

  /* FOOTER */
  .pastel-footer {
    text-align: center;
    margin-top: 40px;
    color: #6f7b8f;
    font-size: 0.9em;
  }
</style>


        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="assets/vendors/flot/jquery.flot.pie.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>