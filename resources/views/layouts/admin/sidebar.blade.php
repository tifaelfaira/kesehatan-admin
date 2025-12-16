<div class="sidebar">
    <div class="sidebar-content">
        <!-- Header -->
        <div class="sidebar-header">
            <h4>
                <i class="bi bi-heart-pulse me-2"></i>Kesehatan Desa
            </h4>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-badge-wrapper">
                <span class="notif-badge">3</span>
                <img src="{{ asset('assets/images/aira.jpg') }}" alt="Foto Admin" class="profile-img">
            </div>
            <h6 class="profile-name">{{ Auth::user()->name ?? 'Roujwa Tifaelfaira' }}</h6>
            <small class="profile-role">Admin Kesehatan</small>
        </div>

        <hr class="sidebar-divider">

        <!-- Navigation Menu -->
        <div class="sidebar-menu">

            <!-- DASHBOARD -->
            <div class="menu-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- FITUR UTAMA -->
            <div class="menu-section">
                <small class="section-label">Fitur Utama</small>

                <div class="menu-item">
                    <a href="{{ route('jadwal.index') }}"
                        class="menu-link {{ request()->is('admin/jadwal*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Jadwal Posyandu</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('admin.layanan-posyandu.index') }}"
                        class="menu-link {{ request()->is('admin/layanan-posyandu*') ? 'active' : '' }}">
                        <i class="bi bi-hospital"></i>
                        <span>Layanan Posyandu</span>
                    </a>
                </div>

                <!-- TAMBAHAN: Menu Data Posyandu -->
                <div class="menu-item">
                    <a href="{{ route('admin.posyandu.index') }}"
                        class="menu-link {{ request()->is('admin/posyandu*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-plus"></i>
                        <span>Data Posyandu</span>
                    </a>
                </div>

                <!-- TAMBAHAN: Menu Kader Posyandu -->
                <div class="menu-item">
                    <a href="{{ route('admin.kader-posyandu.index') }}"
                        class="menu-link {{ request()->is('admin/kader-posyandu*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Kader Posyandu</span>
                    </a>
                </div>

                <!-- TAMBAHAN: Menu Catatan Imunisasi -->
                <div class="menu-item">
                    <a href="{{ route('admin.catatan-imunisasi.index') }}"
                        class="menu-link {{ request()->is('admin/catatan-imunisasi*') ? 'active' : '' }}">
                        <i class="bi bi-file-medical"></i>
                        <span>Catatan Imunisasi</span>
                    </a>
                </div>
            </div>

            <!-- MASTER DATA -->
            <div class="menu-section">
                <small class="section-label">Master Data</small>

                <div class="menu-item">
                    <a href="{{ route('user.index') }}"
                        class="menu-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <span>Data User</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('warga.index') }}"
                        class="menu-link {{ request()->is('admin/warga*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Data Warga</span>
                    </a>
                </div>

                <!-- MENU DATA KESEHATAN DIHAPUS -->

            </div>

            <!-- MENU LAPORAN DIHAPUS -->

        </div>
    </div>

    <!-- Logout Section - Fixed at Bottom -->
    <div class="sidebar-footer">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-100">
            @csrf
            <button type="submit" class="btn logout-btn">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </div>
</div>
