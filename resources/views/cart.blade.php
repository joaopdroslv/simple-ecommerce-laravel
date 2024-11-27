@extends('layout')

@section('title') Shopping Cart @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">
        <i class="material-icons">shopping_cart</i>
        Shopping Cart
    </h1>
    <hr class="mt-4">

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mb-5 mt-5">{{ session()->get('error') }}</div>
    @endif

    @if (!$cartProducts->isEmpty())
            <div class="mt-4 d-flex justify-content-end">
                <form action="{{ route('carts.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center">
                        <i class="material-icons me-2">delete</i>
                        Clear my shopping cart
                    </button>
                </form>
            </div>
            <div class="mt-4 row d-flex justify-content-start">
                <div class="col-md-7">
                    @foreach ($cartProducts as $cartProduct)
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-md-4 d-flex align-items-center">
                                    <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}"
                                        class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ Str::limit($cartProduct->product->name, 60) }}</h4>
                                        <hr>
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <p class="card-text fs-6">unity price ${{ number_format($cartProduct->price, 2) }}
                                                </p>
                                                <p class="card-text fs-6">quantity [ {{ $cartProduct->quantity }} ]</p>
                                                <p class="card-text fs-6">subtotal ${{ number_format($cartProduct->subTotal(), 2) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                                <form action="{{ route('carts.addOne', ['product' => $cartProduct->product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-primary ms-2 d-flex align-items-center justify-content-center"
                                                        style="border-radius: 100px;">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('carts.removeOne', ['product' => $cartProduct->product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-primary ms-2 d-flex align-items-center justify-content-center"
                                                        style="border-radius: 100px;">
                                                        <i class="material-icons">remove</i>
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('carts.removeAll', ['product' => $cartProduct->product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-danger ms-2 d-flex align-items-center justify-content-center"
                                                        style="border-radius: 100px;">
                                                        <i class="material-icons">delete</i>
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
                <div class="container card col-md-5 d-flex align-items-center justify-content-center" style="height: 400px;">
                    <div class="col-md-10">
                        <div class="row">
                            <h4>${{ number_format($cartTotal, 2) }}</h4>
                        </div>
                        <small class="text-body-secondary row mt-4">* pay in up to 12 installments by credit card</small>
                        <small class="text-body-secondary row">* 10% discount for cash payment</small>
                        <hr class="mt-4">
                        <form action="{{ route('orders.checkout') }}" method="POST">
                            <div class="row mt-4">
                                @csrf

                                <label for="address_id" class="form-label">Shipping Address</label>
                                @if (!$addresses->isEmpty())
                                    <select name="address_id" class="form-select">
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->id }}">
                                                {{ $address->street . " | " . $address->number }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p>It is necessary to register a delivery address before checkout.</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row mt-4">
                                        <button type="submit" href=""
                                            class="btn btn-success d-flex align-items-center justify-content-center">
                                            <i class="material-icons me-2">shopping_cart_checkout</i>
                                            Checkout</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-5">
            Your shopping cart is empty, try adding something! <a href="{{ route('products.getAll') }}">go to products</a>
        </div>
    @endif
</div>

@endsection