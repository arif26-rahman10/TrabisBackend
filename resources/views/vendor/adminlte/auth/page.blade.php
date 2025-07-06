@extends('adminlte::master')

@section('adminlte_css')
    <style>
        body.login-page {
            background: linear-gradient(to right, #eef2f3, #8e9eab);
        }
        .login-box {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);
        }
        .login-logo a {
            font-weight: bold;
            color: #007bff;
        }
        .card {
            border-radius: 10px;
        }
    </style>
@stop

@section('classes_body', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">
                <i class="fas fa-user-shield"></i> <b>Admin</b>Trabis
            </a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">@yield('auth_header', 'Silakan Login')</p>

                @yield('auth_body')

                @if (View::hasSection('auth_footer'))
                    <hr>
                    <div class="text-center">
                        @yield('auth_footer')
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
