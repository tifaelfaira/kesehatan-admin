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
                <img src="https://i.pravatar.cc/80?img=68" alt="Foto Admin" class="profile-img">
            </div>
            <h6 class="profile-name">{{ Auth::user()->name ?? 'Roujwa Tifaelfaira' }}</h6>
            <small class="profile-role">Admin Kesehatan</small>
        </div>

        <hr class="sidebar-divider">

        <!-- Navigation Menu -->
        <div class="sidebar-menu">
            <!-- DASHBOARD -->
            <div class="menu-item">
                <a href="{{ url('/admin/dashboard') }}" class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- FITUR UTAMA -->
            <div class="menu-section">
                <small class="section-label">Fitur Utama</small>
                <div class="menu-item">
                    <a href="{{ url('/admin/jadwal') }}" class="menu-link {{ request()->is('admin/jadwal*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Jadwal Kesehatan</span>
                    </a>
                </div>
            </div>

            <!-- MASTER DATA -->
            <div class="menu-section">
                <small class="section-label">Master Data</small>
                <div class="menu-item">
                    <a href="{{ url('/admin/user') }}" class="menu-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        <span>Data User</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('/admin/warga') }}" class="menu-link {{ request()->is('admin/warga*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Data Warga</span>
                    </a>
                </div>
            </div>

            <!-- LAPORAN -->
            <div class="menu-item">
                <a href="{{ url('/admin/laporan') }}" class="menu-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan</span>
                </a>
            </div>
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