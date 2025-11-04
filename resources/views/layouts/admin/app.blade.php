<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard Admin Kesehatan Desa')</title>

  <!-- Bootstrap & Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(180deg, #dce9ff 0%, #f7fbff 100%);
      font-family: "Poppins", sans-serif;
      color: #444;
    }

    /* SIDEBAR */
    .sidebar {
      width: 230px;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      background: linear-gradient(180deg, #b8d0ff 0%, #8cbcff 50%, #6aa9ff 100%);
      color: white;
      padding-top: 1rem;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar h4 {
      text-align: center;
      font-weight: 600;
      color: #fff;
      margin-bottom: 1rem;
    }

    .sidebar hr {
      border-color: rgba(255, 255, 255, 0.3);
      margin: 0.5rem 0 1rem;
    }

    .sidebar .profile {
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
    }

    .sidebar .profile img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .sidebar .profile h6 {
      margin-top: 10px;
      margin-bottom: 0;
      font-weight: 500;
      color: #fff;
    }

    .sidebar .profile small {
      color: rgba(255,255,255,0.8);
      font-size: 13px;
    }

    .sidebar .notif-badge {
      position: absolute;
      top: 5px;
      right: 90px;
      background: #ff3b8a;
      color: #fff;
      font-size: 11px;
      padding: 3px 6px;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-left: 4px solid transparent;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 15px;
    }

    .sidebar a i {
      margin-right: 8px;
      font-size: 1rem;
    }

    .sidebar a:hover, .sidebar a.active {
      background: rgba(255, 255, 255, 0.25);
      border-left: 4px solid #fff;
      transform: translateX(4px);
    }

    /* Label kategori */
    .sidebar small {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    /* Tombol Logout di bawah */
    .logout {
      margin-top: auto;
      background: rgba(255,255,255,0.15);
      border-top: 1px solid rgba(255,255,255,0.3);
      text-align: left;
      font-weight: 500;
      padding: 10px 20px;
    }
    .logout:hover {
      background: rgba(255,255,255,0.3);
    }

    /* NAVBAR */
    .navbar-custom {
      margin-left: 230px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      padding: 15px 30px;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .navbar-custom h5 {
      font-weight: 600;
      color: #0d6efd;
      margin: 0;
    }

    .navbar-profile {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      position: relative;
    }

    .navbar-profile img {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      object-fit: cover;
    }

    .navbar-profile span {
      font-weight: 500;
      color: #444;
    }

    .notif-icon {
      position: relative;
      margin-right: 20px;
      font-size: 20px;
      color: #0d6efd;
    }

    .notif-icon::after {
      content: '';
      position: absolute;
      top: 2px;
      right: 2px;
      width: 8px;
      height: 8px;
      background: #ff3b8a;
      border-radius: 50%;
    }

    .dropdown-menu {
      font-size: 14px;
    }

    .content {
      margin-left: 230px;
      padding: 35px;
      animation: fadeIn 0.8s ease;
      min-height: 100vh;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* =============================== */
    /* FLOATING WHATSAPP BUTTON STYLES */
    /* =============================== */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 25px;
        right: 25px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        text-decoration: none;
        animation: pulse-whatsapp 2s infinite;
    }

    .whatsapp-float:hover {
        background-color: #128C7E;
        color: white;
        transform: scale(1.1) rotate(5deg);
        animation: none;
        box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.4);
    }

    .whatsapp-float::after {
        content: "Hubungi via WhatsApp";
        position: absolute;
        right: 70px;
        bottom: 15px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        font-family: "Poppins", sans-serif;
    }

    .whatsapp-float:hover::after {
        opacity: 1;
    }

    /* Animasi pulse untuk WhatsApp */
    @keyframes pulse-whatsapp {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Tooltip untuk mobile */
    .whatsapp-float::before {
        content: "";
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        background: #ff3b8a;
        border-radius: 50%;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 50%, 100% { opacity: 1; }
        25%, 75% { opacity: 0.3; }
    }

    /* Responsif untuk mobile */
    @media (max-width: 768px) {
        .whatsapp-float {
            width: 55px;
            height: 55px;
            bottom: 20px;
            right: 20px;
            font-size: 26px;
        }

        .whatsapp-float::after {
            font-size: 12px;
            right: 65px;
            padding: 6px 10px;
        }

        .whatsapp-float::before {
            width: 16px;
            height: 16px;
            top: -6px;
            right: -6px;
        }
    }

    /* Untuk layar sangat kecil */
    @media (max-width: 480px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 15px;
            right: 15px;
            font-size: 24px;
        }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <h4><i class="bi bi-heart-pulse"></i> Kesehatan Desa</h4>

      <div class="profile">
        <span class="notif-badge">3</span>
        <img src="https://i.pravatar.cc/80?img=68" alt="Foto Admin">
        <h6>{{ Auth::user()->name ?? 'Roujwa Tifaelfaira' }}</h6>
        <small>Admin Kesehatan</small>
      </div>

      <hr>

      <!-- DASHBOARD -->
      <a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i> Dashboard
      </a>

      <!-- FITUR UTAMA -->
      <small class="d-block text-white-50 fw-semibold px-3 mt-3 mb-1">Fitur Utama</small>
      <a href="{{ url('/admin/jadwal') }}" class="{{ request()->is('admin/jadwal*') ? 'active' : '' }}">
        <i class="bi bi-folder"></i> jadwal kesehatan
      </a>

      <!-- MASTER DATA -->
      <small class="d-block text-white-50 fw-semibold px-3 mt-3 mb-1">Master Data</small>
      <a href="{{ url('/admin/user') }}" class="{{ request()->is('admin/user*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Data User
      </a>
      <a href="{{ url('/admin/warga') }}" class="{{ request()->is('admin/warga*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Data Warga
      </a>

      <!-- Menu Lama (masih dipertahankan) -->
      <a href="{{ url('/admin/laporan') }}" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text"></i> Laporan
      </a>
    </div>

    <!-- ✅ Logout di bawah -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn logout text-white w-100 text-start">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
      </button>
    </form>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-custom d-flex justify-content-between align-items-center">
    <h5>💙 Dashboard Admin Kesehatan Desa</h5>

    <div class="d-flex align-items-center">
      <div class="notif-icon">
        <i class="bi bi-bell-fill"></i>
      </div>

      <div class="dropdown">
        <div class="navbar-profile dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://i.pravatar.cc/80?img=68" alt="Foto Admin">
          <span>{{ Auth::user()->name ?? 'Roujwa Tifaelfaira' }}</span>
        </div>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
          <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i> Profil</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">
    @yield('content')
  </div>

  <!-- Floating WhatsApp Button -->
  <!--
      Format WhatsApp API:
      https://wa.me/[nomor_dengan_kode_negara]?text=[pesan_terencode]

      Contoh:
      https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20layanan%20kesehatan%20desa

      Ganti nomor 6281234567890 dengan nomor WhatsApp admin yang sebenarnya
  -->
  <a href="https://wa.me/6281266903256?text=Halo%20Admin%20Kesehatan%20Desa%2C%20saya%20ingin%20bertanya%20tentang%20layanan%3A"
     class="whatsapp-float"
     target="_blank"
     rel="noopener noreferrer"
     title="Chat via WhatsApp">
      <i class="bi bi-whatsapp"></i>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
