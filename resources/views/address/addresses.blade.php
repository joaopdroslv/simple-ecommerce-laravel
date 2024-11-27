@extends('layout')

@section('title') Addresses @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">
        <i class="material-icons">list</i>
        Addresses
    </h1>
    <hr class="mt-4">
    <div class="mt-4 d-flex justify-content-end">
        <a href="{{ route("addresses.create") }}"
            class="btn btn-success d-flex align-items-center justify-content-center">
            <i class="material-icons me-2">add</i>
            Create
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mb-5 mt-5">{{ session()->get('error') }}</div>
    @endif

    @if (!$addresses->isEmpty())
        <div class="mt-4 row d-flex justify-content-start">
            <div class="col">
                @foreach ($addresses as $address)
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h4 class="card-title">{{ Str::limit($address->street, 60) }} | {{ $address->number }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <p> {{ $address->city }} </p>
                                            <p> {{ $address->state }} </p>
                                            <p class="card-text mt-3">
                                                <small class="text-body-secondary">
                                                    Last updated {{ $address->updated_at->diffForHumans() }}
                                                </small>
                                            </p>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-end">
                                            <a href="{{ route('addresses.edit', ['address' => $address->id]) }}"
                                                class="btn btn-primary ms-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons me-2">edit</i>
                                                Edit
                                            </a>
                                            <a href="{{ route('addresses.show', ['address' => $address->id]) }}"
                                                class="btn btn-primary ms-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons me-2">visibility</i>
                                                Detail
                                            </a>
                                            <form action="{{ route('addresses.destroy', ['address' => $address->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-primary ms-2 d-flex align-items-center justify-content-center">
                                                    <i class="material-icons me-2">delete</i>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-5">
            You have no registered addresses!
        </div>
    @endif
</div>

@endsection