@extends('layout')

@section('title') Orders @endsection

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="d-flex align-items-center">
            <i class="material-icons">list</i>
            <h2 class="mb-0 ms-3">Orders</h2>
        </div>
    </div>
    <hr class="mt-3 mb-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Number</th>
                <th>User</th>
                <th>Shipped To</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->first_name . " " . $order->user->last_name }}</td>
                    <td>{{ $order->address->street . ", " . $order->address->number }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>
                        <a href="" class="btn btn-primary">
                            <i class="material-icons" style="margin-right: 4px; vertical-align: middle;">visibility</i>
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-5 mb-5">
        {{ $orders->links('components/pagination') }}
    </div>
</div>

@endsection