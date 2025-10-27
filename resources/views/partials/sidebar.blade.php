<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <!-- Logo Sidebar -->
  <div class="text-center sidebar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
    </a>
  </div>

  <ul class="nav">
    {{-- Profil Admin --}}
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-medium mb-2">Roujwa Tifaelfaira</span>
          <span class="font-weight-normal text-muted">Admin Kesehatan</span>
        </div>
      </a>
    </li>

    {{-- Menu Dashboard --}}
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- Menu Jadwal Kesehatan --}}
    <li class="nav-item {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
        <i class="mdi mdi-calendar menu-icon"></i>
        <span class="menu-title">Jadwal</span>
      </a>
    </li>

    {{-- Menu Data Warga --}}
    <li class="nav-item {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.warga.index') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Data Warga</span>
      </a>
    </li>

    {{-- Menu Manajemen User (baru) --}}
    <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="mdi mdi-account-key menu-icon"></i>
        <span class="menu-title">Manajemen User</span>
      </a>
    </li>

    {{-- Menu Laporan --}}
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="mdi mdi-file-document-box menu-icon"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>

    {{-- Tombol Logout --}}
    <li class="nav-item mt-3">
      <a class="nav-link text-danger" href="{{ url('/auth') }}">
        <i class="mdi mdi-logout menu-icon"></i>
        <span class="menu-title">Keluar</span>
      </a>
    </li>
  </ul>
</nav>

