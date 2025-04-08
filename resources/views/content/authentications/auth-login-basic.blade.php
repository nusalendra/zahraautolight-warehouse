@extends('layouts/blankLayout')
@section('title', 'Login - Modern Dashboard')
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
                <span class="app-brand-logo">@include('_partials.macros',["width"=>40,"withbg"=>'#fff'])</span>
              </a>
            </div>
            <h2 class="welcome-title">Welcome Back</h2>
            <p class="welcome-text">Sign in to continue your journey with {{config('variables.templateName')}}</p>
            <div class="welcome-image">
              <img src="/assets/img/illustrations/login-visual.svg" alt="Login illustration" class="img-fluid">
            </div>
          </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="auth-form-container">
          <div class="auth-form-wrapper">
            <h3 class="form-title">Sign In</h3>
            <p class="form-subtitle">Please enter your credentials to access your account</p>

            <form id="formAuthentication" class="auth-form" action="{{url('/')}}" method="GET">
              <div class="form-group">
                <label for="email" class="form-label">Email or Username</label>
                <div class="input-wrapper">
                  <i class="bx bx-user input-icon"></i>
                  <input type="text" class="form-control" id="email" name="email-username"
                    placeholder="Enter your email or username" autofocus>
                </div>
              </div>

              <div class="form-group form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{url('auth/forgot-password-basic')}}" class="forgot-link">
                    Forgot Password?
                  </a>
                </div>
                <div class="input-wrapper">
                  <i class="bx bx-lock-alt input-icon"></i>
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="••••••••" aria-describedby="password" />
                  <span class="password-toggle cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="form-group remember-checkbox">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Remember me on this device
                  </label>
                </div>
              </div>

              <div class="form-actions">
                <button class="btn btn-primary btn-login" type="submit">
                  <i class="bx bx-log-in me-2"></i> Sign In
                </button>
              </div>
            </form>

            <div class="auth-divider">
              <span>or sign in with</span>
            </div>

            <div class="social-login">
              <button class="btn btn-outline-secondary social-btn">
                <i class="bx bxl-google"></i>
              </button>
              <button class="btn btn-outline-secondary social-btn">
                <i class="bx bxl-facebook"></i>
              </button>
              <button class="btn btn-outline-secondary social-btn">
                <i class="bx bxl-twitter"></i>
              </button>
            </div>

            <div class="auth-footer">
              <p>
                Don't have an account?
                <a href="{{url('auth/register-basic')}}" class="register-link">
                  Create an account
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--bs-primary-bg-subtle) 0%, var(--bs-secondary-bg-subtle) 100%);
    padding: 2rem;
  }

  .auth-wrapper {
    width: 100%;
    max-width: 1100px;
  }

  .auth-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .auth-content {
    display: flex;
    min-height: 600px;
  }

  .auth-welcome {
    flex: 1;
    background: var(--bs-primary);
    color: #fff;
    padding: 3rem;
    position: relative;
    display: flex;
    align-items: center;
  }

  .welcome-inner {
    position: relative;
    z-index: 2;
  }

  .welcome-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
  }

  .welcome-text {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
  }

  .welcome-image {
    margin-top: 2rem;
    max-width: 90%;
  }

  .auth-form-container {
    flex: 1;
    padding: 3rem;
    display: flex;
    align-items: center;
  }

  .auth-form-wrapper {
    width: 100%;
  }

  .form-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--bs-heading-color);
  }

  .form-subtitle {
    color: var(--bs-secondary-color);
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
    color: var(--bs-secondary-color);
  }

  .auth-form .form-control {
    padding: 0.8rem 1rem 0.8rem 2.8rem;
    border-radius: 8px;
    border: 1px solid var(--bs-border-color);
  }

  .password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--bs-secondary-color);
  }

  .forgot-link {
    font-size: 0.875rem;
    color: var(--bs-primary);
  }

  .remember-checkbox {
    margin-bottom: 1.8rem;
  }

  .btn-login {
    width: 100%;
    padding: 0.8rem;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .auth-divider {
    text-align: center;
    position: relative;
    margin: 1.5rem 0;
  }

  .auth-divider::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    background: var(--bs-border-color);
  }

  .auth-divider span {
    position: relative;
    background: #fff;
    padding: 0 1rem;
    font-size: 0.875rem;
    color: var(--bs-secondary-color);
  }

  .social-login {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
  }

  .social-btn {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
  }

  .auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.95rem;
  }

  .register-link {
    font-weight: 600;
    color: var(--bs-primary);
  }

  @media (max-width: 992px) {
    .auth-content {
      flex-direction: column;
    }

    .auth-welcome {
      padding: 2rem;
      text-align: center;
      display: flex;
      justify-content: center;
    }

    .welcome-image {
      display: none;
    }
  }
</style>
@endsection