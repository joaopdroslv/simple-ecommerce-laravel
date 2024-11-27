@extends('layout')

@section('title') Product Details @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">info</i>
        Product Details
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="name" class="form-control" value="{{$product->name}}" readonly>
                <label for="name">Name</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="brand" id="" class="form-control" value="{{$product->brand}}" readonly>
                <label for="brand">Brand</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="description" class="form-control" value="{{$product->description}}" readonly>
                <label for="description">Description</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="price" class="form-control" value="{{$product->price}}" readonly>
                <label for="price">Unit Prince</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="category" class="form-control" value="{{$product->category->name}}" readonly>
                <label for="category">Category</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="created_at" class="form-control" value="{{$product->created_at}}" readonly>
                <label for="created_at">Created At</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="updated_at" class="form-control" value="{{$product->updated_at}}" readonly>
                <label for="updated_at">Updated At</label>
            </div>
        </div>
        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('products.index') }}">Go Back</a>
            <button type="submit" class="btn btn-danger w-25">Delete</button>
        </div>
    </form>
</div>

@endsection