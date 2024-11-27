@extends('layout')

@section('title') User Details @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">info</i>
        User Details
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" readonly>
                <label for="first_name">First Name</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="Last Name" id="" class="form-control" value="{{$user->last_name}}" readonly>
                <label for="Last Name">Last Name</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="user_type" class="form-control" value="{{$user->user_type}}" readonly>
                <label for="user_type">E-mail</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
                <label for="email">E-mail</label>
            </div>
        </div>
        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('users.index') }}">Go Back</a>
            <button type="submit" class="btn btn-danger w-25">Delete</button>
        </div>
    </form>
</div>

@endsection