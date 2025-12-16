<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.admin.header')
    @include('layouts.admin.css')
</head>

<body>

    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <!-- Main Wrapper -->
    <div class="main-panel">

        <!-- Navbar -->
        <nav class="navbar navbar-custom d-flex justify-content-between align-items-center">
            <h5>💙 Dashboard Admin Kesehatan Desa</h5>

            <div class="d-flex align-items-center">
                <div class="notif-icon">
                    <i class="bi bi-bell-fill"></i>
                </div>

                <div class="dropdown">
                    <div class="navbar-profile dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/aira.jpg') }}" class="profile-img">
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer (PINDAH KE SINI) -->
        {{-- @include('layouts.admin.footer') --}}
        <footer class="footer mt-5 bg-white border-top">
            <div class="container-fluid px-4">
                <div
                    class="d-flex flex-column flex-md-row
                    align-items-center
                    justify-content-between
                    py-3 text-center">

                    <div class="text-muted small mb-2 mb-md-0">
                        © {{ date('Y') }}
                        <strong class="text-primary">Kesehatan Desa</strong>.
                        All rights reserved.
                    </div>

                    <div class="text-muted small pe-5">
                        Built with <i class="bi bi-heart-fill text-danger"></i>
                        using
                        <a href="https://www.bootstrapdash.com/" target="_blank"
                            class="fw-semibold text-primary text-decoration-none">
                            BootstrapDash
                        </a>
                    </div>

                </div>
            </div>
        </footer>

    </div>

    <!-- Floating WhatsApp -->
    <a href="https://wa.me/6281266903256" class="whatsapp-float" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>

    @include('layouts.admin.js')
</body>

</html>
