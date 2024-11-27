@extends('layout')

@section('title') Order Details @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">info</i>
        Details | {{ $order->order_number }}
    </h2>
    <hr class="mt-3 mb-5">
    <p class="fs-5">- Ordered {{ $order->created_at->diffForHumans() }}</p>
    <p class="fs-5">- Ordered at {{ $order->created_at }}</p>
    <p class="fs-5">- Shipped to {{ $order->address->street . ", " . $order->address->number }}</p>
    <p class="fs-5">- Total ${{ number_format($order->total, 2) }}</p>
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">list</i>
        Order Products
    </h2>
    <hr class="mt-3 mb-5">
    @foreach ($order->orderProducts as $orderProduct)
        <div class="card mb-3">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}" class="img-fluid rounded-start"
                        alt="...">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h4 class="card-title">{{ Str::limit($orderProduct->product->name, 60) }}</h4>
                        <hr>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="card-text fs-6">unity price ${{ number_format($orderProduct->price, 2) }}
                                </p>
                                <p class="card-text fs-6">quantity [ {{ $orderProduct->quantity }} ]</p>
                                <p class="card-text fs-6">subtotal ${{ number_format($orderProduct->subTotal(), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection