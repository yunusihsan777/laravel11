@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="content" id="content">
    <div class="container-fluid px-0">

        <!-- Header Banner -->
        <div class="card page-hero-card mb-4 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-warning text-dark px-2 py-1 fw-bold">
                                <i class="bi bi-shield-lock-fill me-1"></i>Keamanan Akun
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1 text-white">Pembaruan Kata Sandi</h3>
                        <p class="text-white-50 mb-0 small">
                            Pastikan kata sandi Anda kuat dan diperbarui secara berkala demi menjaga integritas data SAKIP.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-3 p-2 text-white" style="background: var(--kj-emerald);">
                                <i class="bi bi-key-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Form Ubah Password</h5>
                                <small class="text-muted">Masukkan password saat ini dan buat password baru</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- Notifikasi Sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center gap-2 py-3 px-4 rounded-3 border-0 shadow-sm mb-4">
                                <i class="bi bi-check-circle-fill fs-4 text-success flex-shrink-0"></i>
                                <div>
                                    <div class="fw-bold">Berhasil!</div>
                                    <small>{{ session('success') }}</small>
                                </div>
                            </div>
                        @endif

                        {{-- Notifikasi Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger py-3 px-4 rounded-3 border-0 shadow-sm mb-4">
                                <div class="d-flex align-items-center gap-2 fw-bold mb-1 text-danger">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Password Lama -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">
                                    <i class="bi bi-lock text-warning me-1"></i>Password Lama <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" class="form-control input-password-field" id="current_password" name="current_password" placeholder="Masukkan password saat ini" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="current_password" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Baru -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">
                                    <i class="bi bi-key text-warning me-1"></i>Password Baru <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-plus"></i></span>
                                    <input type="password" class="form-control input-password-field" id="new_password" name="new_password" placeholder="Minimal 6 karakter" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="new_password" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">
                                    <i class="bi bi-check2-circle text-warning me-1"></i>Konfirmasi Password Baru <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" class="form-control input-password-field" id="new_password_confirmation" name="new_password_confirmation" placeholder="Ketik ulang password baru" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-pwd-btn" data-target="new_password_confirmation" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Tips Keamanan Box -->
                            <div class="p-3 rounded-3 bg-light border mb-4 small text-muted">
                                <div class="fw-bold text-dark mb-1 d-flex align-items-center gap-1">
                                    <i class="bi bi-info-circle text-primary"></i> Tips Keamanan Password:
                                </div>
                                <ul class="mb-0 ps-3">
                                    <li>Gunakan kombinasi huruf besar, huruf kecil, dan angka.</li>
                                    <li>Jangan bagikan password kepada pihak yang tidak berwenang.</li>
                                </ul>
                            </div>

                            <!-- Action Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-yellow py-2_5 fw-bold shadow-sm">
                                    <i class="bi bi-save2 me-1"></i> Simpan Perubahan Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-pwd-btn').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                if (input && icon) {
                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    icon.classList.toggle('bi-eye', !isPassword);
                    icon.classList.toggle('bi-eye-slash', isPassword);
                }
            });
        });
    });
</script>
@endpush
@endsection
