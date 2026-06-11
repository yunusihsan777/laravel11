<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPIP Terintegrasi Tahun 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c3e50; /* Latar belakang biru gelap */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px 50px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .login-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
            white-space: normal;
            word-wrap: break-word;
            hyphens: none;
        }
        .login-subtitle {
            color: #7f8c8d;
            font-size: 1rem;
            margin-bottom: 35px;
            text-align: center;
            white-space: normal;
            word-wrap: break-word;
            hyphens: none;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            color: #34495e;
            font-size: 0.95rem;
        }
        .form-control::placeholder {
            color: #7f8c8d;
        }
        .form-select {
            background-color: #ecf0f1; /* Latar belakang abu-abu muda untuk dropdown */
            cursor: pointer;
        }
        .btn-login {
            background-color: #3498db;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            color: white;
            margin-bottom: 30px;
            transition: background-color 0.2s;
        }
        .btn-login:hover {
            background-color: #2980b9;
        }
        .login-footer {
            border-top: 1px solid #ecf0f1;
            padding-top: 25px;
            text-align: center;
            font-size: 0.85rem;
            color: #7f8c8d;
            white-space: normal;
            word-wrap: break-word;
            hyphens: none;
        }
        .login-footer strong {
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="login-title">SPIP Terintegrasi Tahun 2026</h3>
        <p class="login-subtitle">Kertas Kerja 3.1</p>

        <!-- Pesan Error -->
        @if($errors->has('login_error'))
            <div class="alert alert-danger" style="border-radius: 8px; font-size: 0.9rem; text-align: center;">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ url('/login-spip') }}" method="POST">
            @csrf

            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <select name="jenis_penilaian" class="form-select" required>
                <option value="pm">Penilaian Mandiri</option>
                <option value="pk">Penilaian Kualitas</option>
            </select>

            <button type="submit" class="btn btn-login">LOGIN</button>
        </form>

        <div class="login-footer">
            Copyright &copy; 2026 <strong>Kertas Kerja 3.1 SPIP Terintegrasi</strong><br>
            Developed by <strong>Panev Birocana Team</strong> | Powered by Google Apps Script
        </div>
    </div>

</body>
</html>
