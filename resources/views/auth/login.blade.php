@extends('layout')

@section('content')

@if (auth()->check())

    <div class="container d-flex justify-content-center align-items-center w-50" style="min-height: 100vh">
        <div class="col text-center">
            <div class="row w-100 mb-5">
                <p>
                    You're already logged in as <span class="text-uppercase">{{ auth()->user()->first_name }}</span>
                </p>
            </div>
            <div class="row w-100 justify-content-around">
                <a href="{{ route('home') }}" class="btn btn-primary w-25">Go to homepage</a>
                <a href="{{ route('login.destroy') }}" class="btn btn-danger w-25">Logout</a>
            </div>
        </div>
    </div>

@else

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form action="{{ route('login.store') }}" method="POST" class="w-25 needs-validation" novalidate>
            <h2>Login</h2>
            <hr class="mt-4 mb-5">
            @csrf

            <div class="input-group has-validation">
                <div class="form-floating">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="">
                    <label for="email">E-mail</label>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group has-validation mt-3">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        value="{{ old('password') }}" placeholder="">
                    <label for="password">Password</label>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                Don't have an account? <a href="{{ route('login.register') }}">Register now</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-5">Login</button>

            @error('error')
                <div class="alert alert-danger mt-3">{{ $message }}</div>
            @enderror
        </form>
    </div>

@endif

@endsection