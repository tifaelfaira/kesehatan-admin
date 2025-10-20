main blade

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kesehatan Admin</title>

  {{-- ===== CSS bawaan Breeze ===== --}}
  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

  {{-- ===== Custom style agar lebih rapi & bersih ===== --}}
  <style>
    body {
      font-family: "Inter", "Poppins", sans-serif;
      background-color: #f9fafb;
      color: #333;
    }

    .navbar {
      background: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      border-bottom: 1px solid #e5e7eb;
    }

    .navbar-brand {
      font-weight: 600;
      font-size: 1.25rem;
      color: #2563eb !important;
    }

    .sidebar {
      width: 240px;
      background-color: #2563eb;
      color: #fff;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 80px;
      transition: all 0.3s ease;
    }

    .sidebar .nav-item {
      margin: 4px 8px;
    }

    .sidebar .nav-link {
      color: #e0e7ff;
      display: flex;
      align-items: center;
      padding: 10px 15px;
      border-radius: 6px;
      transition: background 0.2s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-item.active .nav-link {
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    .sidebar .menu-icon {
      margin-right: 10px;
      font-size: 18px;
    }

    .main-panel {
      margin-left: 240px;
      padding: 80px 30px 30px;
    }

    .content-wrapper {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      min-height: calc(100vh - 150px);
    }

    .footer {
      margin-left: 240px;
      padding: 15px 0;
      background-color: #fff;
      border-top: 1px solid #e5e7eb;
      text-align: center;
      color: #777;
      font-size: 0.9rem;
    }

    .btn {
      border-radius: 6px;
    }

    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
  </style>
</head>

<body>
  {{-- ===== Navbar atas ===== --}}
  <nav class="navbar fixed-top d-flex justify-content-between align-items-center px-4">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Kesehatan Admin</a>
    <ul class="navbar-nav navbar-nav-right mb-0 d-flex align-items-center">
      <li class="nav-item nav-profile">
        <a class="nav-link d-flex align-items-center text-dark" href="#">
          <i class="mdi mdi-account-circle text-primary me-2"></i>
          <span class="fw-semibold">Admin</span>
        </a>
      </li>
    </ul>
  </nav>

  {{-- ===== Sidebar ===== --}}
  <nav class="sidebar" id="sidebar">
    <ul class="nav flex-column">
      <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="mdi mdi-view-dashboard menu-icon"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ request()->is('kesehatan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kesehatan.index') }}">
          <i class="mdi mdi-hospital menu-icon"></i>
          <span>Data Kesehatan</span>
        </a>
      </li>

      <li class="nav-item {{ request()->is('jadwal') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('jadwal') }}">
          <i class="mdi mdi-calendar menu-icon"></i>
          <span>Jadwal</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-cog menu-icon"></i>
          <span>Pengaturan</span>
        </a>
      </li>
    </ul>
  </nav>

  {{-- ===== Konten utama ===== --}}
  <div class="main-panel">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>

  {{-- ===== Footer ===== --}}
  <footer class="footer">
    © 2025 Kesehatan Admin
  </footer>

  {{-- ===== Script JS Breeze ===== --}}
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
</body>
</html>
