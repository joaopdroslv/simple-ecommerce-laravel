@extends('layout')

@section('title')
Edit Product
@endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">edit</i>
        Edit Product
    </h2>
    <hr class="mt-3 mb-5">

    @if (session()->has('success'))
        <div class="alert alert-success mb-5">{{ session()->get('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger mb-5">{{ session()->get('error') }}</div>
    @endif

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="name" class="form-control" placeholder="" value="{{ $product->name }}">
                <label for="name">Name</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="brand" id="" class="form-control" placeholder="" value="{{ $product->brand }}">
                <label for="brand">Brand</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="description" class="form-control" placeholder=""
                    value="{{ $product->description }}">
                <label for="description">Description</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="price" class="form-control" placeholder="" value="{{ $product->price }}">
                <label for="price">Price</label>
            </div>
            <small class="form-text">* Use only "." to set the price, for example 1000.99</small>
        </div>
        <div class="mb-3">
            <select name="category_id" class="form-control">
                <option value="">Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="category_id" class="form-label"></label>
        </div>
        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('products.index') }}">Go Back</a>
            <input type="submit" class="btn btn-success w-25" value="Confirm">
        </div>
    </form>
</div>

@endsection