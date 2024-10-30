@extends('layout')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <form action="{{ route('login.create') }}" method="POST" class="w-25 needs-validation" novalidate>
        <h2>Register</h2>
        <hr class="mt-4 mb-5">

        @csrf

        <div class="input-group has-validation">
            <div class="form-floating">
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}" placeholder="">
                <label for="first_name">First Name</label>
            </div>
            @error('first_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group has-validation mt-3">
            <div class="form-floating">
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}" placeholder="">
                <label for="last_name">Last Name</label>
            </div>
            @error('last_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group has-validation mt-3">
            <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
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
                    placeholder="">
                <label for="password">Password</label>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group has-validation mt-3">
            <div class="form-floating">
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="">
                <label for="password_confirmation">Confirm Password</label>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-5">Register</button>

        @error('error')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </form>
</div>

@endsection