<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #cfe8ff 0%, #eaf3ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(142, 179, 255, 0.25);
            padding: 40px 35px;
            text-align: center;
            width: 360px;
            position: relative;
            animation: floatUp 0.8s ease-out;
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon-top {
            background: linear-gradient(135deg, #73b7ff, #9fd3ff);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-size: 28px;
            box-shadow: 0 5px 10px rgba(120, 160, 255, 0.3);
        }

        h3 {
            color: #7ab6ff;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        label {
            font-weight: 500;
            color: #4a5d79;
            text-align: left;
            width: 100%;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbdcff;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #8cbfff;
            box-shadow: 0 0 5px rgba(140, 191, 255, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #63aaff, #92c8ff);
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #559fff, #7fc0ff);
            transform: translateY(-2px);
        }

        footer {
            font-size: 0.9em;
            color: #6a7aa6;
            margin-top: 15px;
        }

        footer i {
            color: #6da8ff;
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

        .bubble {
            position: absolute;
            background: rgba(173, 209, 255, 0.5);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    <!-- Bubble hiasan -->
    <div class="bubble" style="width:50px; height:50px; left:10%; bottom:15%; animation-delay: 0s;"></div>
    <div class="bubble" style="width:70px; height:70px; right:15%; top:20%; animation-delay: 2s;"></div>
    <div class="bubble" style="width:30px; height:30px; left:40%; top:10%; animation-delay: 4s;"></div>

    <div class="card shadow p-4">
        <div class="icon-top">🩺</div>
        <h3>Form Login</h3>

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
            <div class="mb-3 text-start">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}">
            </div>

            <div class="mb-3 text-start">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

            <p class="mb-0">Belum punya akun? 
                <a href="{{ url('/auth/register') }}" class="register-link">Daftar di sini</a>
            </p>
        </form>

        <footer>© {{ date('Y') }} Sistem Kesehatan Desa <i>💙</i></footer>
    </div>
</body>
</html>
