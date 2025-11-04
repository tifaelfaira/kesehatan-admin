<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kesehatan Desa</title>
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

        /* Overlay untuk readability */
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

        .login-container {
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

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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

        .features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 30px;
            width: 100%;
            max-width: 250px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 15px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateX(5px);
        }

        .feature i {
            font-size: 14px;
            color: #e3f2ff;
        }

        .login-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: #7ab6ff;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .login-subtitle {
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

        footer {
            font-size: 0.9em;
            color: #6a7aa6;
            margin-top: 20px;
            text-align: center;
        }

        a.register-link {
            color: #5a9cff;
            text-decoration: none;
            font-weight: 500;
        }

        a.register-link:hover {
            text-decoration: underline;
            color: #3a86ff;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }

        .bubble {
            position: absolute;
            background: rgba(173, 209, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
            z-index: -1;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
            }

            .brand-section {
                padding: 40px 30px;
            }

            .login-section {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Bubble hiasan -->
    <div class="bubble" style="width:50px; height:50px; left:10%; bottom:15%; animation-delay: 0s;"></div>
    <div class="bubble" style="width:70px; height:70px; right:15%; top:20%; animation-delay: 2s;"></div>
    <div class="bubble" style="width:30px; height:30px; left:40%; top:10%; animation-delay: 4s;"></div>

    <div class="login-container">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="logo-container">
                <i class="logo-icon bi bi-heart-pulse"></i>
            </div>
            <h1 class="brand-title">Sistem Kesehatan Desa</h1>
            <p class="brand-subtitle">
                Platform terintegrasi untuk mengelola pelayanan kesehatan masyarakat desa secara digital dan efisien.
            </p>

            <div class="features">
                <div class="feature">
                    <i class="bi bi-people"></i>
                    <span>Manajemen Data Warga</span>
                </div>
                <div class="feature">
                    <i class="bi bi-calendar-check"></i>
                    <span>Jadwal Kesehatan</span>
                </div>
                <div class="feature">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Laporan Terintegrasi</span>
                </div>
                <div class="feature">
                    <i class="bi bi-graph-up"></i>
                    <span>Monitoring Kesehatan</span>
                </div>
            </div>
        </div>

        <!-- Login Form Section -->
        <div class="login-section">
            <div class="login-header">
                <h2 class="login-title">Form Login</h2>
                <p class="login-subtitle">Silakan masuk dengan akun Anda</p>
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

            <form action="{{ url('/auth/login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                    <i class="input-icon bi bi-person"></i>
                </div>

                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="input-icon bi bi-lock"></i>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>

            <div class="register-link text-center mt-3">
                <p class="mb-0">Belum punya akun?
                    <a href="{{ url('/auth/register') }}" class="register-link">Daftar di sini</a>
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
