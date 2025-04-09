@extends('layouts/blankLayout')
@section('title', 'Zahra Auto Light')
@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="auth-container">
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-content">
        <!-- Left side - Branding & Welcome -->
        <div class="auth-welcome">
          <div class="welcome-inner">
            <div class="app-brand">
              <a href="{{url('/')}}" class="app-brand-link">
                <span class="app-brand-logo-wrapper">
                  <img src="/assets/img/icons/brands/logo-product.jpeg" alt="Zahra Auto Light" class="logo-image">
                </span>
              </a>
            </div>
            <h2 class="welcome-title">Zahra Auto Light</h2>
            <p class="welcome-text">Sistem Manajemen Persediaan & Penjualan</p>
            <div class="welcome-decoration">
              <div class="decoration-circle circle-1"></div>
              <div class="decoration-circle circle-2"></div>
              <div class="decoration-circle circle-3"></div>
            </div>
          </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="auth-form-container">
          <div class="auth-form-wrapper">
            <h3 class="form-title">Halaman Login</h3>
            <p class="form-subtitle">Silakan login dengan menggunakan informasi akun Anda</p>

            <form id="formAuthentication" class="auth-form" action="{{ route('login-store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <div class="input-wrapper">
                  <i class="bx bx-user input-icon"></i>
                  <input type="text" class="form-control" id="username" name="username" required
                    placeholder="Masukkan Username Anda" autofocus>
                </div>
              </div>

              <div class="form-group form-password-toggle">
                <div class="input-wrapper">
                  <i class="bx bx-lock-alt input-icon"></i>
                  <input type="password" id="password" class="form-control" name="password" required
                    placeholder="••••••••" aria-describedby="password" />
                  <span class="password-toggle cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="form-actions">
                <button class="btn btn-primary btn-login" type="submit">
                  <i class="bx bx-log-in me-2"></i> Masuk
                </button>
              </div>
            </form>

            <div class="system-info">
              <p class="system-version">Zahra Auto Light Management System v1.0</p>
              <p class="copyright">© 2025 Zahra Auto Light. All rights reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('error'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Aksi Dihentikan',
    text: "{{ session('error') }}",
  });
</script>
@endif

<style>
  :root {
    --primary-color: #0F4C81;
    --accent-color: #FF6B35;
    --text-light: #F5F5F5;
    --text-dark: #333333;
    --border-radius: 12px;
  }

  .auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
    padding: 2rem;
  }

  .auth-wrapper {
    width: 100%;
    max-width: 1100px;
  }

  .auth-card {
    background: #fff;
    border-radius: var(--border-radius);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .auth-content {
    display: flex;
    min-height: 580px;
  }

  .auth-welcome {
    flex: 1;
    background: #222;
    color: var(--text-light);
    padding: 3rem;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .welcome-inner {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 100%;
  }

  .app-brand {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
  }

  .app-brand-logo-wrapper {
    display: inline-block;
    background: #000;
    padding: 10px;
    border-radius: 12px;
    height: 120px;
    width: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .logo-image {
    max-width: 100%;
    max-height: 100px;
    border-radius: 8px;
  }

  .welcome-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    background: linear-gradient(90deg, #fff, #e0e0e0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .welcome-text {
    font-size: 1.1rem;
    opacity: 0.8;
    margin-bottom: 2rem;
    color: #f0f0f0;
  }

  .welcome-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    overflow: hidden;
  }

  .decoration-circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
  }

  .circle-1 {
    width: 300px;
    height: 300px;
    background: var(--accent-color);
    top: -100px;
    right: -100px;
  }

  .circle-2 {
    width: 200px;
    height: 200px;
    background: var(--primary-color);
    bottom: -50px;
    left: -50px;
  }

  .circle-3 {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .auth-form-container {
    flex: 1;
    padding: 3rem;
    display: flex;
    align-items: center;
    background: #fff;
  }

  .auth-form-wrapper {
    width: 100%;
  }

  .form-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
  }

  .form-subtitle {
    color: #666;
    margin-bottom: 2rem;
  }

  .auth-form .form-group {
    margin-bottom: 1.5rem;
  }

  .input-wrapper {
    position: relative;
  }

  .input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
  }

  .auth-form .form-control {
    padding: 0.8rem 1rem 0.8rem 2.8rem;
    border-radius: var(--border-radius);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
  }

  .auth-form .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(15, 76, 129, 0.1);
  }

  .password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
    cursor: pointer;
  }

  .forgot-link {
    font-size: 0.875rem;
    color: var(--primary-color);
    font-weight: 500;
  }

  .btn-login {
    width: 100%;
    padding: 0.8rem;
    border-radius: var(--border-radius);
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--primary-color);
    border: none;
    transition: all 0.3s ease;
  }

  .btn-login:hover {
    background: #0a3d6a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(15, 76, 129, 0.25);
  }

  .system-info {
    margin-top: 3rem;
    text-align: center;
    color: #888;
  }

  .system-version {
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
  }

  .copyright {
    font-size: 0.8rem;
  }

  @media (max-width: 992px) {
    .auth-content {
      flex-direction: column;
    }

    .auth-welcome {
      padding: 2rem;
    }

    .app-brand-logo-wrapper {
      height: 100px;
      width: 100px;
    }

    .logo-image {
      max-height: 80px;
    }

    .welcome-title {
      font-size: 1.8rem;
    }

    .circle-1 {
      display: none;
    }
  }

  @media (max-width: 576px) {
    .auth-container {
      padding: 1rem;
    }

    .auth-form-container {
      padding: 2rem 1.5rem;
    }

    .auth-welcome {
      padding: 2rem 1.5rem;
    }
  }
</style>
@endsection