@extends('layout')

@section('title') Products @endsection

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-5">
        <div class="d-flex align-items-center">
            <i class="material-icons">list</i>
            <h2 class="mb-0 ms-3">Products</h2>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success d-flex align-items-center">
            <i class="material-icons me-2">add</i>
            Create
        </a>
    </div>
    <hr class="mt-3 mb-5">

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mb-5 mt-5">{{ session()->get('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ Str::limit($product->name, 30) }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-primary">
                            <i class="material-icons" style="margin-right: 4px; vertical-align: middle;">visibility</i>
                            Details
                        </a>
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">
                            <i class="material-icons" style="margin-right: 4px; vertical-align: middle;">edit</i>
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-5 mb-5">
        {{ $products->links('components/pagination') }}
    </div>
</div>

@endsection