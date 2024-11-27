@extends('layout')

@section('title') Wishlist @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">
        <i class="material-icons">list</i>
        Wish List
    </h1>
    <hr class="mt-4">

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mb-5 mt-5">{{ session()->get('error') }}</div>
    @endif

    @if (!$wishlistItems->isEmpty())
        <div class="mt-4 d-flex justify-content-end">
            <form action="{{ route('wishlists.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center">
                    <i class="material-icons me-2">delete</i>
                    Clear my wish list
                </button>
            </form>
        </div>
        <div class="mt-4 row d-flex justify-content-start">
            <div class="col-md-12">
                @foreach ($wishlistItems as $wishlistItem)
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-2 d-flex align-items-center">
                                <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}"
                                    class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h4 class="card-title">{{ Str::limit($wishlistItem->product->name, 60) }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <p>
                                                {{ Str::limit($wishlistItem->product->description, 75) }}
                                            </p>
                                            <div class="stars d-flex align-items-center">
                                                Users rated it
                                                <div class="ms-3">
                                                    @for ($i = 1; $i <= $wishlistItem->product->averageRating(); $i++)
                                                        <i class="material-icons text-warning">star_rate</i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="card-text mt-3">
                                                <small class="text-body-secondary">
                                                    Last updated {{ $wishlistItem->product->updated_at->diffForHumans() }}
                                                </small>
                                            </p>
                                            <h4 class="card-text">
                                                ${{ number_format($wishlistItem->product->price, 2) }}
                                            </h4>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-end">
                                            <form action="{{ route('wishlists.destroy', ['wishlist' => $wishlistItem->id]) }}"
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
            Your wish list is empty, try adding something! <a href="{{ route('products.getAll') }}">go to products</a>
        </div>
    @endif
</div>

@endsection