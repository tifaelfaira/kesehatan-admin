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