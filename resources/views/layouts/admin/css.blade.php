<style>
    /* ===== VARIABLES & BASE STYLES ===== */
    :root {
        --blue-dark: #0d47a1;
        --blue-primary: #1565c0;
        --blue-secondary: #1e88e5;
        --blue-info: #42a5f5;
        --blue-light: #64b5f6;
        --blue-ultralight: #e3f2fd;
        --blue-success: #1976d2;
        --blue-warning: #ff9800;
        --pink-accent: #ff3b8a;
        --whatsapp-green: #25d366;
        --whatsapp-dark: #128C7E;
    }

    body {
        background: linear-gradient(180deg, #dce9ff 0%, #f7fbff 100%);
        font-family: "Poppins", sans-serif;
        color: #444;
    }

        /* ===== SIDEBAR STYLES ===== */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: linear-gradient(180deg, #b8d0ff 0%, #8cbcff 50%, #6aa9ff 100%);
        color: white;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .sidebar-content {
        flex: 1;
        padding: 1.5rem 1rem;
        overflow-y: auto;
    }

    .sidebar-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .sidebar-header h4 {
        font-weight: 600;
        color: #fff;
        margin-bottom: 0;
    }

    .profile-section {
        text-align: center;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .profile-badge-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .notif-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff3b8a;
        color: white;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
        border: 2px solid #6aa9ff;
    }

    .profile-name {
        font-weight: 600;
        color: #fff;
        margin: 0.5rem 0 0.25rem 0;
    }

    .profile-role {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
    }

    .sidebar-divider {
        border-color: rgba(255, 255, 255, 0.3);
        margin: 1.5rem 0;
    }

    /* Menu Sections */
    .menu-section {
        margin-bottom: 1rem;
    }

    .section-label {
        display: block;
        color: rgba(255, 255, 255, 0.7) !important;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0 0.75rem;
        margin-bottom: 0.5rem;
    }

    .menu-item {
        margin-bottom: 0.25rem;
    }

    .menu-link {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 15px;
    }

    .menu-link:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border-left-color: rgba(255, 255, 255, 0.5);
        transform: translateX(4px);
    }

    .menu-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border-left-color: #fff;
        transform: translateX(4px);
    }

    .menu-link i {
        font-size: 1rem;
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 0;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.15);
    }

    .logout-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.9);
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        text-align: left;
    }

    .logout-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .profile-section {
        text-align: center;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .profile-badge-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .notif-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--pink-accent);
        color: white;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
        border: 2px solid var(--blue-dark);
    }

    .profile-name {
        font-weight: 600;
        color: #fff;
        margin: 0.5rem 0 0.25rem 0;
    }

    .profile-role {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
    }

    .sidebar-divider {
        border-color: rgba(255, 255, 255, 0.3);
        margin: 1.5rem 0;
    }

    /* Menu Sections */
    .menu-section {
        margin-bottom: 1rem;
    }

    .section-label {
        display: block;
        color: rgba(255, 255, 255, 0.7) !important;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0 0.75rem;
        margin-bottom: 0.5rem;
    }

    .menu-item {
        margin-bottom: 0.25rem;
    }

    .menu-link {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .menu-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-left-color: rgba(255, 255, 255, 0.5);
        transform: translateX(5px);
    }

    .menu-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border-left-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .menu-link i {
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
        margin-right: 0.5rem;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.1);
    }

    .logout-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.9);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        text-align: left;
    }

    .logout-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    /* ===== NAVBAR STYLES ===== */
    .navbar-custom {
        margin-left: 260px;
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
        color: var(--blue-primary);
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
        color: var(--blue-primary);
    }

    .notif-icon::after {
        content: '';
        position: absolute;
        top: 2px;
        right: 2px;
        width: 8px;
        height: 8px;
        background: var(--pink-accent);
        border-radius: 50%;
    }

    .dropdown-menu {
        font-size: 14px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* ===== CONTENT AREA ===== */
    .content {
        margin-left: 260px;
        padding: 2rem;
        animation: fadeIn 0.8s ease;
        min-height: 100vh;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== BLUE THEME UTILITIES ===== */
    .text-blue-dark { color: var(--blue-dark) !important; }
    .text-blue-primary { color: var(--blue-primary) !important; }
    .text-blue-secondary { color: var(--blue-secondary) !important; }
    .text-blue-info { color: var(--blue-info) !important; }
    .text-blue-light { color: var(--blue-light) !important; }
    .text-blue-success { color: var(--blue-success) !important; }
    .text-blue-warning { color: var(--blue-warning) !important; }

    .bg-blue-dark { background-color: var(--blue-dark) !important; }
    .bg-blue-primary { background-color: var(--blue-primary) !important; }
    .bg-blue-secondary { background-color: var(--blue-secondary) !important; }
    .bg-blue-info { background-color: var(--blue-info) !important; }
    .bg-blue-light { background-color: var(--blue-light) !important; }
    .bg-blue-ultralight { background-color: var(--blue-ultralight) !important; }
    .bg-blue-success { background-color: var(--blue-success) !important; }
    .bg-blue-warning { background-color: var(--blue-warning) !important; }

    /* Button Styles */
    .btn-light-blue {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
    }
    .btn-light-blue:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .btn-outline-blue-primary {
        border-color: var(--blue-primary);
        color: var(--blue-primary);
    }
    .btn-outline-blue-primary:hover {
        background-color: var(--blue-primary);
        color: white;
    }

    .btn-outline-blue-secondary {
        border-color: var(--blue-secondary);
        color: var(--blue-secondary);
    }
    .btn-outline-blue-secondary:hover {
        background-color: var(--blue-secondary);
        color: white;
    }

    .btn-outline-blue-info {
        border-color: var(--blue-info);
        color: var(--blue-info);
    }
    .btn-outline-blue-info:hover {
        background-color: var(--blue-info);
        color: white;
    }

    /* Table Styles */
    .table-blue-light {
        background-color: var(--blue-ultralight) !important;
    }

    /* ===== DASHBOARD COMPONENTS ===== */
    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .stat-card {
        border-left: 4px solid;
    }

    .stat-card .icon-wrapper {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 0.75rem;
        border-radius: 50%;
    }

    .timeline-item {
        border-left: 2px solid #e9ecef;
        padding-left: 1rem;
    }

    .timeline-icon {
        margin-left: -1.5rem;
    }

    /* ===== WHATSAPP FLOATING BUTTON ===== */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 25px;
        right: 25px;
        background-color: var(--whatsapp-green);
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
        background-color: var(--whatsapp-dark);
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

    .whatsapp-float::before {
        content: "";
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        background: var(--pink-accent);
        border-radius: 50%;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 50%, 100% { opacity: 1; }
        25%, 75% { opacity: 0.3; }
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .sidebar {
            width: 240px;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .content,
        .navbar-custom {
            margin-left: 0;
        }

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

    @media (max-width: 480px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 15px;
            right: 15px;
            font-size: 24px;
        }

        .content {
            padding: 1rem;
        }
    }

    /* ===== SCROLLBAR STYLING ===== */
    .sidebar-content::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-content::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    .sidebar-content::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>