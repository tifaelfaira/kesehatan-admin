<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Breeze Admin')</title>

    <!-- CSS -->
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
      
      {{-- Sidebar --}}
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
          </a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
          </a>
        </div>

        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                <span class="login-status online"></span>
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2">Administrator</span>
                <span class="font-weight-normal">Admin Panel</span>
              </div>
            </a>
          </li>

          {{-- Dashboard --}}
          <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          {{-- Jadwal Kesehatan --}}
          <li class="nav-item {{ request()->is('admin/jadwal*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.jadwal') }}">
              <i class="mdi mdi-calendar menu-icon"></i>
              <span class="menu-title">Jadwal Kesehatan</span>
            </a>
          </li>

          {{-- Tambahan menu lain --}}
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Pengaturan</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="container-fluid page-body-wrapper">
        {{-- Navbar bisa diletakkan di sini kalau mau --}}

        {{-- Konten utama --}}
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            @yield('content')
          </div>

          {{-- Footer --}}
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                Copyright © bootstrapdash.com 2020
              </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a>
              </span>
            </div>
          </footer>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/vendors/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  </body>
</html>
