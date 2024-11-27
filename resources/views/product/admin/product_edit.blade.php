@extends('layout')

@section('title') Edit Product @endsection

@section('content')

<div class="container">
    <h2 class="mt-5 d-flex align-items-center">
        <i class="material-icons me-2">edit</i>
        Edit Product
    </h2>
    <hr class="mt-3 mb-5">
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $product->name }}" placeholder="">
                <label for="name">Name</label>
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="brand" id="" class="form-control @error('brand') is-invalid @enderror"
                    value="{{ $product->brand }}" placeholder="">
                <label for="brand">Brand</label>
            </div>
            @error('brand')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                    value="{{ $product->description }}" placeholder="">
                <label for="description">Description</label>
            </div>
            @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                    value="{{ $product->price }}" placeholder="">
                <label for="price">Price</label>
            </div>
            <small class="form-text">* Use only "." to set the price, for example 1000.99</small>
            @error('price')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="has-validation mb-3">
            <div class="form-floating">
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="" selected>...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($product->category->id == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <label for="category_id">Category</label>
            </div>
            @error('category_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="w-50 mt-5">
            <a type="button" class="btn btn-primary w-25" href="{{ route('products.index') }}">Go Back</a>
            <input type="submit" class="btn btn-success w-25" value="Confirm">
        </div>
    </form>
</div>

@endsection