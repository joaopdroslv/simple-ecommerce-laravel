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
        <form action="{{ route('products.byFilter') }}" method="GET" class="w-75">
            @csrf

            @if(!empty($category))
                <input type="hidden" name="category_id" value="{{ $category->id }}">
            @endif

            <div class="input-group">
                <input type="text" name="product_name" class="form-control form-control-lg"
                    value="{{ request()->input('product_name') }}" placeholder="Search in products...">
                <select name="sort_order" class="form-select form-select-lg ms-4">
                    <option value="" {{ request()->input('sort_order') === '' ? 'selected' : '' }}>
                        sort by
                    </option>
                    <option value="asc" {{ request()->input('sort_order') === 'asc' ? 'selected' : '' }}>
                        price: low to high
                    </option>
                    <option value="desc" {{ request()->input('sort_order') === 'desc' ? 'selected' : '' }}>
                        price: high to low
                    </option>
                </select>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center w-25">
                    <i class="material-icons me-2">search</i> search
                </button>
            </div>
        </form>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success mb-5 mt-5">{{ session()->get('success') }}</div>
    @endif

    @error('error')
        <div class="alert alert-danger mt-5">{{ $message }}</div>
    @enderror

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
                                <div class="stars d-flex align-items-center">
                                    Users rated it
                                    <div class="ms-3">
                                        @for ($i = 1; $i <= $product->averageRating(); $i++)
                                            <i class="material-icons text-warning">star_rate</i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="card-text mt-3">
                                    <small class="text-body-secondary">
                                        Last updated {{ $product->updated_at->diffForHumans() }}
                                    </small>
                                </p>
                                <h4 class="mt-3">${{ number_format($product->price, 2) }}</h4>
                                <div class="w-100 d-flex align-items-center justify-content-end mt-4">
                                    <a href="{{ route('products.detail', ['product' => $product->id]) }}"
                                        class="btn btn-primary ms-2">
                                        see more
                                    </a>
                                    <form action="{{ route('carts.addOne', ['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-success d-flex align-items-center justify-content-center ms-2">
                                            <i class="material-icons me-3">add_shopping_cart</i>
                                            add to cart
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
</div>
<div class="container mt-5 mb-5">
    {{--
    -> 'request()->query()' returns all parameters of the current request,
    including the filters you applied (such as 'product_name', 'sort_order', and 'category_id').

    -> The 'appends()' method ensures that these settings are maintained
    across pagination URLs, allowing the user to navigate pages without losing applied filters.
    --}}
    {{ $products->appends(request()->query())->links('components/pagination') }}
</div>

@endsection