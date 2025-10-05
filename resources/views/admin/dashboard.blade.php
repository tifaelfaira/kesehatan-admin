<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        /* ===== Tema Biru Pastel Cute & Modern ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #d8eaff 0%, #f5faff 100%);
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        header {
            background: linear-gradient(135deg, #69b9ff, #9dd2ff);
            color: white;
            padding: 25px 10px;
            text-align: center;
            font-size: 1.4em;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .container {
            margin: 60px auto;
            padding: 40px;
            max-width: 850px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(120,180,255,0.2);
            text-align: center;
            animation: slideIn 0.8s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            color: #78b8f5; /* 🌸 Soft blue */
            margin-bottom: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        p {
            color: #5a6b89;
            font-size: 1em;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .emoji {
            font-size: 1.3em;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        a.btn {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #5ea8ff, #8ac8ff);
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.95em;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        a.btn:hover {
            background: linear-gradient(135deg, #4e9eff, #78bfff);
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            margin-top: 115px; /* 🔼 dinaikkan sedikit agar jarak bawah pas */
            padding-bottom: 30px;
            color: #6f7b8f;
            font-size: 0.9em;
        }

        .emoji-blue {
            color: #6eb8ff;
        }

        /* Efek animasi transisi ke halaman jadwal */
        .btn-transition {
            position: relative;
            overflow: hidden;
        }

        .btn-transition::after {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.5s ease;
        }

        .btn-transition:hover::after {
            left: 100%;
        }
    </style>
</head>
<body>
    <header>
        💙 Dashboard Admin Kesehatan Desa Sehat
    </header>

    <div class="container">
        <h1>
            Selamat Datang, Airaa!
            <!-- 🔵 Ikon Kesehatan -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="#6eb8ff">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 11h-4v4h-2v-4H7v-2h4V8h2v4h4v2z"/>
            </svg>
        </h1>

        <p>
            Kelola dan pantau jadwal kegiatan kesehatan masyarakat dengan penuh semangat dan kepedulian
            <span class="emoji">🧑‍⚕️</span>
        </p>

        <div class="button-group">
            <a href="{{ url('/admin/jadwal') }}" class="btn btn-transition">📅 Lihat Jadwal Kesehatan</a>
            <a href="{{ url('/auth') }}" class="btn btn-transition">↩ Kembali ke Login</a>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} Sistem Kesehatan Desa — Tetap Sehat & Tebarkan Kasih <span class="emoji-blue">💙</span>
    </footer>
</body>
</html>

