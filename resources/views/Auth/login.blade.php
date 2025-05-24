@extends('layouts.app')

<!-- Custom fonts for this template-->
<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg w-100" style="max-width: 400px;">
            <div class="card-body">
                <!-- Form Login -->
                <div class="text-center mb-4">
                    <i class="fas fa-cash-register fa-3x text-primary mb-2"></i>
                    <h1 class="h4 text-gray-900 font-weight-bold">QuickKas</h1>
                </div>                
                <form method="POST" action="{{ route('login') }}" class="user">
                    @csrf
                    <div class="form-group">
                        <input type="email"
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Enter Email Address...">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password"
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="password" name="password" required autocomplete="current-password"
                            placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
