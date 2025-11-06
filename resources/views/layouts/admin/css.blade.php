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