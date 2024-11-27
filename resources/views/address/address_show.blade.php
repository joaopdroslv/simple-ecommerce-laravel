@extends('layout')

@section('title') Address Details @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">info</i>
        Address Details
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('addresses.destroy', ['address' => $address->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="street" class="form-control" value="{{ $address->street }}" readonly>
                <label for="street">Street</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="number" class="form-control" value="{{ $address->number }}" readonly>
                <label for="number">Number</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="city" id="" class="form-control" value="{{ $address->city }}" readonly>
                <label for="city">City</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="state" class="form-control" value="{{ $address->state }}" readonly>
                <label for="state">State</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="created_at" class="form-control" value="{{ $address->created_at }}" readonly>
                <label for="created_at">Created At</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="updated_at" class="form-control" value="{{ $address->updated_at }}" readonly>
                <label for="updated_at">Updated At</label>
            </div>
        </div>
        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('addresses.index') }}">Go Back</a>
            <button type="submit" class="btn btn-danger w-25">Delete</button>
        </div>
    </form>
</div>

@endsection