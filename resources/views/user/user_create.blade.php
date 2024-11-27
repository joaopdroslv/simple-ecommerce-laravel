@extends('layout')

@section('title') Create User @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">add_circle</i>
        Create User
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}" placeholder="">
                <label for="first_name">First Name</label>
            </div>
            @error('first_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="last_name" id="" class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}" placeholder="">
                <label for="last_name">Last Name</label>
            </div>
            @error('last_name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <select name="user_type" class="form-control @error('user_type') is-invalid @enderror">
                    <option value="" selected>...</option>
                    <option value="admin" @selected(old('user_type') == 'admin')>Admin</option>
                    <option value="customer" @selected(old('user_type') == 'customer')>Customer</option>
                </select>
                <label for="user_type">User Type</label>
            </div>
            @error('user_type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mt-3">
            <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="">
                <label for="email">E-mail</label>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mt-3">
            <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="">
                <label for="password">Password</label>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mt-3">
            <div class="form-floating">
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="">
                <label for="password_confirmation">Confirm Password</label>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('users.index') }}">Go Back</a>
            <input type="submit" class="btn btn-success w-25" value="Create">
        </div>
    </form>
</div>

@endsection