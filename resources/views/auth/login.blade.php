<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-SAKIP - Kejaksaan Agung Republik Indonesia</title>
    <link rel="icon" href="{{ asset('gambar/kejaksaan.png') }}" type="image/png">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --kj-emerald: #0f5132;
            --kj-emerald-dark: #0a3622;
            --kj-gold: #e6bf3e;
            --kj-gold-dark: #d4a517;
            --kj-gold-gradient: linear-gradient(135deg, #e6bf3e 0%, #d4a517 100%);
            --kj-emerald-gradient: linear-gradient(135deg, #0a3622 0%, #0f5132 100%);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0b1f14;
            background-image: linear-gradient(rgba(10, 31, 20, 0.82), rgba(10, 31, 20, 0.88)), url('{{ asset('gambar/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1.5px solid rgba(230, 191, 62, 0.35);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            animation: cardAppear 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-header-banner {
            background: var(--kj-emerald-gradient);
            padding: 30px 24px 24px;
            text-align: center;
            color: #ffffff;
            position: relative;
            border-bottom: 3px solid var(--kj-gold);
        }

        .login-logo-ring {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #ffffff;
            padding: 5px;
            margin: 0 auto 14px;
            border: 2.5px solid var(--kj-gold);
            box-shadow: 0 0 16px rgba(230, 191, 62, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-logo-ring img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-body {
            padding: 30px 28px 24px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 1.5px solid #cbd5e1;
            color: #64748b;
            border-radius: 10px 0 0 10px;
        }

        .form-control {
            border: 1.5px solid #cbd5e1;
            border-radius: 0 10px 10px 0;
            padding: 0.65rem 0.9rem;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--kj-gold);
            box-shadow: 0 0 0 3px rgba(230, 191, 62, 0.25);
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--kj-gold);
            color: var(--kj-emerald);
        }

        .password-toggle-btn {
            border: 1.5px solid #cbd5e1;
            border-left: none;
            background-color: #ffffff;
            color: #64748b;
            border-radius: 0 10px 10px 0;
            padding: 0 14px;
            transition: color 0.2s;
        }

        .password-toggle-btn:hover {
            color: var(--kj-emerald);
        }

        .input-password-field {
            border-radius: 0 !important;
        }

        .btn-login {
            background: var(--kj-gold-gradient);
            color: #ffffff;
            border: 1px solid var(--kj-gold-dark);
            border-radius: 10px;
            padding: 0.7rem 1.5rem;
            font-size: 0.98rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            width: 100%;
            box-shadow: 0 4px 14px rgba(212, 165, 23, 0.3);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #d4a517 0%, #b8860b 100%);
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(212, 165, 23, 0.45);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        .login-footer-text {
            font-size: 0.78rem;
            color: #94a3b8;
            text-align: center;
            margin-top: 24px;
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Header Banner with Logo -->
        <div class="login-header-banner">
            <div class="login-logo-ring">
                <img src="{{ asset('gambar/kejaksaan.png') }}" alt="Logo Kejaksaan RI">
            </div>
            <h4 class="fw-bold mb-1" style="letter-spacing: 0.5px;">E-SAKIP KEJAKSAAN RI</h4>
            <p class="mb-0 text-white-50 small">Sistem Akuntabilitas Kinerja Instansi Pemerintah</p>
            <div class="mt-2">
                <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.72rem; font-weight: 700;">
                    <i class="bi bi-shield-check me-1"></i>Biro Perencanaan Kejaksaan Agung
                </span>
            </div>
        </div>

        <!-- Form Body -->
        <div class="login-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 mb-4 rounded-3 border-0 shadow-sm" style="font-size: 0.86rem;">
                    <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                        <i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Kode Satker Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-person-badge text-warning me-1"></i>Kode Satker
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                        <input type="text" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Masukkan Kode Satker"
                               required 
                               autofocus 
                               autocomplete="username">
                    </div>
                </div>

                <!-- Password Field with Show/Hide Toggle -->
                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="bi bi-shield-lock text-warning me-1"></i>Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" 
                               class="form-control input-password-field" 
                               id="password" 
                               name="password" 
                               placeholder="Masukkan Password"
                               required 
                               autocomplete="current-password">
                        <button type="button" 
                                class="btn password-toggle-btn" 
                                id="togglePasswordBtn" 
                                title="Lihat / Sembunyikan Password"
                                tabindex="-1">
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Masuk ke Sistem</span>
                </button>
            </form>

            <p class="login-footer-text">
                Panev Biro Perencanaan Kejaksaan RI &copy; {{ date('Y') }}
            </p>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (toggleBtn && passwordInput && passwordIcon) {
                toggleBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    passwordIcon.classList.toggle('bi-eye', !isPassword);
                    passwordIcon.classList.toggle('bi-eye-slash', isPassword);
                });
            }
        });
    </script>
</body>
</html>
