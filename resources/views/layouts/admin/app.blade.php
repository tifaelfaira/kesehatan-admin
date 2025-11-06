<!DOCTYPE html>
<html lang="id">
<head>
  @include('layouts.admin.header')
  @include('layouts.admin.css')
</head>
<body>

  <!-- Sidebar -->
  @include('layouts.admin.sidebar')

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
  <a href="https://wa.me/6281266903256?text=Halo%20Admin%20Kesehatan%20Desa%2C%20saya%20ingin%20bertanya%20tentang%20layanan%3A"
     class="whatsapp-float"
     target="_blank"
     rel="noopener noreferrer"
     title="Chat via WhatsApp">
      <i class="bi bi-whatsapp"></i>
  </a>

  @include('layouts.admin.js')
  @include('layouts.admin.footer')
</body>
</html>