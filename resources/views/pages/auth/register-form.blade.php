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
            position: relative;
            z-index: 2;
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

        .register-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, 0.98);
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
            border-radius: 12px;
            border: 1.5px solid #e3eeff;
            box-shadow: none;
            transition: all 0.3s ease;
            padding: 14px 16px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.95);
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #8cbfff;
            box-shadow: 0 0 8px rgba(140, 191, 255, 0.3);
            background: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #63aaff, #92c8ff);
            border: none;
            border-radius: 12px;
            font-weight: 500;
            transition: 0.3s;
            padding: 14px;
            font-size: 16px;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(99, 170, 255, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #559fff, #7fc0ff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 170, 255, 0.4);
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
            font-size: 0.85em;
            color: #6a7aa6;
            margin-top: 25px;
            text-align: center;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #8cbfff;
            z-index: 5;
            font-size: 16px;
        }

        /* GELEMBUNG TIPIS DI BACKGROUND */
        .bubble {
            position: absolute;
            border-radius: 50%;
            animation: floatBubble 20s ease-in-out infinite;
            z-index: 1;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        @keyframes floatBubble {
            0% { 
                transform: translateY(0px) translateX(0px);
                opacity: 0.3;
            }
            25% { 
                transform: translateY(-25px) translateX(10px);
                opacity: 0.5;
            }
            50% { 
                transform: translateY(-15px) translateX(-8px);
                opacity: 0.2;
            }
            75% { 
                transform: translateY(-20px) translateX(5px);
                opacity: 0.4;
            }
            100% { 
                transform: translateY(0px) translateX(0px);
                opacity: 0.3;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                width: 95%;
            }

            .brand-section {
                padding: 40px 30px;
            }

            .register-section {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Gelembung Tipis di Background -->
    <div class="bubble" style="width:70px; height:70px; top:20%; left:10%; animation-delay: 0s;"></div>
    <div class="bubble" style="width:50px; height:50px; bottom:25%; right:12%; animation-delay: 5s;"></div>
    <div class="bubble" style="width:85px; height:85px; top:30%; right:15%; animation-delay: 10s;"></div>
    <div class="bubble" style="width:60px; height:60px; bottom:20%; left:8%; animation-delay: 15s;"></div>

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
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <i class="bi bi-envelope input-icon"></i>
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

            <div class="text-center mt-4">
                <p class="mb-0" style="color: #6a7aa6; font-size: 14px;">
                    Sudah punya akun?
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