@extends('layout')

@section('title') Edit Address @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">edit</i>
        Edit Address
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('addresses.update', ['address' => $address->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="street" class="form-control @error('street') is-invalid @enderror"
                    value="{{ $address->street }}" placeholder="">
                <label for="street">Street</label>
            </div>
            @error('street')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="number" id="" class="form-control @error('number') is-invalid @enderror"
                    value="{{ $address->number }}" placeholder="">
                <label for="number">Number</label>
            </div>
            @error('number')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                    value="{{ $address->city }}" placeholder="">
                <label for="city">City</label>
            </div>
            @error('city')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"
                    value="{{ $address->state }}" placeholder="">
                <label for="state">State</label>
            </div>
            @error('state')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('addresses.index') }}">Go Back</a>
            <input type="submit" class="btn btn-success w-25" value="Confirm">
        </div>
    </form>
</div>

@endsection