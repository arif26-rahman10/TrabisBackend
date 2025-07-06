@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('title', 'Login')

@section('auth_header')
    <h3 class="text-center mb-2 font-weight-bold text-primary">
        <i class="fas fa-user-lock mr-1"></i> AdminTrabis
    </h3>
    <p class="text-center text-muted">Selamat Datang, Silakan Login</p>
@endsection

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="Email atau Username" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text bg-white border-left-0 rounded-pill">
                        <span class="fas fa-envelope text-primary"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <span class="text-danger small d-block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <div class="input-group">
                <input type="password" name="password"
                    class="form-control rounded-pill @error('password') is-invalid @enderror" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text bg-white border-left-0 rounded-pill">
                        <span class="fas fa-lock text-primary"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <span class="text-danger small d-block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Remember Me + Login Button --}}
        <div class="form-group d-flex justify-content-between align-items-center">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-muted">Ingat Saya</label>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-sign-in-alt mr-1"></i> Masuk
            </button>
        </div>
    </form>
@endsection

@section('auth_footer')
    @if (Route::has('password.request'))
        <p class="text-center">
            <a href="{{ route('password.request') }}" class="text-primary">Lupa password?</a>
        </p>
    @endif

    @if (Route::has('register'))
        <p class="text-center">
            <a href="{{ route('register') }}" class="text-primary font-weight-bold">Daftar akun baru</a>
        </p>
    @endif
@endsection

@section('css')
<style>
    .login-page {
        background: linear-gradient(to right, #e3efff, #a3b8cc);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-box {
        width: 100%;
        max-width: 550px;
    }

    .card {
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        background-color: #ffffffee;
    }

    h3 {
        font-size: 2rem;
    }

    .text-muted {
        font-size: 1.1rem;
    }

    .form-control {
        height: 52px;
        font-size: 16px;
        padding-left: 20px;
    }

    .input-group-text {
        font-size: 1.3rem;
        padding: 0 18px;
    }

    .btn-primary {
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 30px;
        font-weight: bold;
    }

    .icheck-primary label {
        font-size: 15px;
    }
</style>
@endsection