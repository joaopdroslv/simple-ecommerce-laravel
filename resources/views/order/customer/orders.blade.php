@extends('layout')

@section('title') Orders @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">
        <i class="material-icons">list</i>
        Orders
    </h1>
    <hr class="mt-4">

    @if (!$orders->isEmpty())
        <div class="mt-4 row d-flex justify-content-start">
            <div class="col">
                @foreach ($orders as $order)
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $order->order_number }}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <p> total ${{ number_format($order->total, 2) }} </p>
                                            <p> shipped to {{ $order->address->street . ", " . $order->address->number }} </p>
                                            <p class="card-text mt-3">
                                                <small class="text-body-secondary">
                                                    ordered {{ $order->created_at->diffForHumans() }}
                                                </small>
                                            </p>
                                            <p class="card-text mt-3">
                                                <small class="text-body-secondary">
                                                    ordered at {{ $order->created_at }}
                                                </small>
                                            </p>
                                        </div>
                                        <div class="col d-flex justify-content-end align-items-end">
                                            <a href="{{ route('orders.detail', ['order' => $order->id]) }}"
                                                class="btn btn-primary ms-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons me-2">visibility</i>
                                                Detail
                                            </a>
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
            You never ordered something!
        </div>
    @endif
</div>

@endsection