@extends('layout')

@section('title') Products @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">
        <i class="material-icons">list</i>
        Products
    </h1>

    @if(!empty($category))
        <h3 class="mt-3 ms-5">IN CATEGORY | {{ $category->name }}</h3>
    @endif

    <hr class="mt-4">
    <div class="mt-5 d-flex justify-content-center">
        <form action="{{ route('products.filter') }}" method="GET" class="w-75">
            @csrf

            @if(!empty($category))
                <input type="hidden" name="category_id" value="{{ $category->id }}">
            @endif

            <div class="input-group">
                <input type="text" name="product_name" class="form-control form-control-lg"
                    value="{{ request()->input('product_name') }}" placeholder="Search by name...">
                <select name="sort_order" class="form-select form-select-lg ms-4">
                    <option value="" {{ request()->input('sort_order') === '' ? 'selected' : '' }}>
                        By price
                    </option>
                    <option value="asc" {{ request()->input('sort_order') === 'asc' ? 'selected' : '' }}>
                        Price low to high
                    </option>
                    <option value="desc" {{ request()->input('sort_order') === 'desc' ? 'selected' : '' }}>
                        Price high to low
                    </option>
                </select>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center w-25">
                    <i class="material-icons me-2">search</i> Search
                </button>
            </div>
        </form>
    </div>
    <div class="row mt-5">
        @foreach ($products as $product)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}"
                                class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ Str::limit($product->name, 25) }}
                                </h5>
                                <p class="card-text">
                                    {{ Str::limit($product->description, 75) }}
                                </p>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                        Last updated {{ $product->updated_at->diffForHumans() }}
                                    </small>
                                </p>
                                <h4>${{ number_format($product->price, 2) }}</h4>
                                <div class="d-flex gap-2 ms-auto mt-4 w-75" style="width: fit-content;">
                                    <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                        class="btn btn-primary w-50 h-100">
                                        See more
                                    </a>
                                    <a href=""
                                        class="btn btn-success d-flex align-items-center justify-content-center w-50 h-100">
                                        <i class="material-icons me-1">add_shopping_cart</i>
                                        Add to cart
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

@endsection