<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Sistem Kesehatan Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('/assets/images/login.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(3px);
            z-index: -1;
        }

        .register-container {
            display: flex;
            width: 900px;
            max-width: 95%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(142, 179, 255, 0.25);
            overflow: hidden;
            animation: floatUp 0.8s ease-out;
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-section {
            flex: 1;
            background: linear-gradient(rgba(116, 183, 255, 0.9), rgba(154, 205, 255, 0.9));
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .logo-container {
            background: rgba(255, 255, 255, 0.2);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        .logo-icon {
            font-size: 35px;
            color: white;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .brand-subtitle {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 300px;
            line-height: 1.6;
        }

        .register-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-title {
            font-size: 24px;
            font-weight: 600;
            color: #7ab6ff;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .register-subtitle {
            color: #6a7aa6;
            font-size: 14px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbdcff;
            box-shadow: none;
            transition: all 0.3s ease;
            padding: 12px 15px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #8cbfff;
            box-shadow: 0 0 5px rgba(140, 191, 255, 0.3);
            background: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #63aaff, #92c8ff);
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            padding: 12px;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #559fff, #7fc0ff);
            transform: translateY(-2px);
        }

        a.login-link {
            color: #5a9cff;
            text-decoration: none;
            font-weight: 500;
        }

        a.login-link:hover {
            text-decoration: underline;
            color: #3a86ff;
        }

        footer {
            font-size: 0.9em;
            color: #6a7aa6;
            margin-top: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="logo-container">
                <i class="logo-icon bi bi-heart-pulse"></i>
            </div>
            <h1 class="brand-title">Sistem Kesehatan Desa</h1>
            <p class="brand-subtitle">
                Bergabunglah untuk membantu pengelolaan data kesehatan masyarakat desa secara digital dan terintegrasi.
            </p>
        </div>

        <!-- Register Section -->
        <div class="register-section">
            <div class="register-header">
                <h2 class="register-title">Form Registrasi</h2>
                <p class="register-subtitle">Silakan isi data untuk membuat akun baru</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/auth/register') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                    <i class="bi bi-person input-icon"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="bi bi-lock input-icon"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    <i class="bi bi-shield-lock input-icon"></i>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus me-2"></i>Daftar
                </button>
            </form>

            <div class="text-center mt-3">
                <p class="mb-0">Sudah punya akun?
                    <a href="{{ url('/auth') }}" class="login-link">Login di sini</a>
                </p>
            </div>

            <footer>
                © {{ date('Y') }} Sistem Kesehatan Desa
                <i class="bi bi-heart-fill" style="color: #ff6b6b;"></i>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
