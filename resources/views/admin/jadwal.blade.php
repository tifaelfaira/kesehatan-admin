<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Kesehatan</title>
    <style>
        /* ===== Tema Soft Blue Pastel ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #cfe8ff 0%, #f4f8ff 100%);
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(135deg, #7db8ff, #b0d3ff);
            color: white;
            text-align: center;
            padding: 25px 10px;
            font-size: 1.4em;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .container {
            margin: 40px auto;
            padding: 30px;
            max-width: 950px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(120,160,255,0.15);
            text-align: center;
        }

        h3 {
            color: #3a72b6;
            margin-top: 0;
        }

        p.subtext {
            color: #5f6f89;
            font-size: 0.95em;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #d6e6ff;
        }

        th {
            background: #79afff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #eef5ff;
        }

        tr:hover {
            background-color: #d7e8ff;
            transition: 0.3s;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        a.btn {
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #64a4ff, #85c3ff);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.95em;
            transition: 0.3s;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }

        a.btn:hover {
            background: linear-gradient(135deg, #5498ff, #77b6ff);
            transform: translateY(-2px);
        }

        footer {
            text-align: center;
            color: #666;
            margin-top: 30px;
            font-size: 0.9em;
        }

        /* ===== Efek Transisi Halaman ===== */
        .page-transition {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .page-transition.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <header>💙 Informasi Jadwal Kesehatan</header>

    <!-- Tambahkan class page-transition di container -->
    <div class="container page-transition">
        <h3>Data Jadwal Terbaru</h3>
        <p class="subtext">Berikut adalah daftar kegiatan kesehatan yang akan dilaksanakan:</p>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tema</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                    <tr>
                        <td>{{ $item['tanggal'] }}</td>
                        <td>{{ $item['tema'] }}</td>
                        <td>{{ $item['keterangan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="button-group">
            <a href="{{ url('/auth') }}" class="btn">← Kembali ke Login</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn">🏠 Kembali ke Dashboard</a>
        </div>
    </div>

    <footer>
        © {{ date('Y') }} Kesehatan Desa Sehat — Tetap Jaga Kesehatan 💧
    </footer>

    <script>
        // Efek muncul lembut setelah halaman dimuat
        document.addEventListener("DOMContentLoaded", function () {
            const page = document.querySelector(".page-transition");
            if (page) {
                setTimeout(() => page.classList.add("active"), 100);
            }
        });
    </script>
</body>
</html>
