@extends('layout')

@section('title') Shopping Cart @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">Products in my shopping cart</h1>
    <hr class="mt-4">
    <div class="row d-flex align-items-center mt-5">
        <div class="col-md-6">
            <h2>Your total is ${{ number_format($cartTotal, 2) }}</h2>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="" class="btn btn-success ms-2">CHECKOUT</a>
            <a href="" class="btn btn-danger ms-2">CLEAR MY SHOPPPING CART</a>
        </div>
    </div>
    <div class="mt-5">
        @foreach ($cartItems as $cartItem)
            <div class="card mb-3 w-100">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h4 class="card-title">{{ Str::limit($cartItem->product->name, 60) }}</h4>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-2">
                                    <p class="card-text fs-6">UNIT PRICE ${{ number_format($cartItem->price, 2) }}</p>
                                    <p class="card-text fs-6">QUANTITY {{ $cartItem->quantity }}</p>
                                </div>
                                <div class="col-md-10 d-flex justify-content-end align-items-center">
                                    <a href="" class="btn btn-primary ms-2">add one</a>
                                    <a href="" class="btn btn-primary ms-2">remove one</a>
                                    <a href="" class="btn btn-danger ms-2">remove all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection