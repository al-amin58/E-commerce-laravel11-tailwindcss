@extends('auth.layouts.app-auth');
@section('title')
    Login
@endsection
@section('auth')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Login</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="card-body card  login-form">
                        <div class="title">
                            <h3>Login Now</h3>
                            @include('errors.message')
                            @if ($errors->any())
                                <div class="mb-4 font-medium text-sm text-red-600" style="color: red;">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="color: red;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('login') }}"  >
                            @csrf
                            <div class="form-group input-group">
                                <label for="email">Email</label>
                                <input name="email" :value="old('email')" class="form-control" type="email" id="email" autofocus autocomplete="email" required placeholder="Enter your email">
                            </div>
                            <div class="form-group input-group">
                                <label for="password">Password</label>
                                <input name="password" class="form-control" type="password" id="password" required autocomplete="current-password" placeholder="Enter your password">
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="lost-pass" href="{{ route('password.request') }}">Forgot password?</a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                            <p class="outer-link">Don't have an account? <a href="{{ route('register') }}">Register here </a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
