@extends('layout')

@section('title') Product Details @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">PRODUCT | {{ $product->name }}</h1>
    <hr class="mt-4">

    @if ($productAlreadyInCart)
        <div class="alert alert-warning mb-4 mt-4 fs-5">
            You already have [{{ $productAlreadyInCart }}] of this product in your shopping cart.
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success mb-4 mt-4 fs-5">{{ session()->get('success') }}</div>
    @endif

    @error('error')
        <div class="alert alert-danger mt-5 fs-5">{{ $message }}</div>
    @enderror

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('assets/imgs/placeholder-product-image.jpg') }}" class="img-fluid rounded-start"
                alt="...">
        </div>
        <div class="col-md-6">
            <h3 class="mt-5">CATEGORY | {{ $product->category->name }}</h3>
            <h3 class="mt-4">BRAND | {{ $product->brand }}</h3>
            <p class="mt-4">{{ $product->description }}</p>
            <small class="text-body-secondary">
                Last updated {{ $product->updated_at->diffForHumans() }}
            </small>
            <div class="stars mt-5 d-flex align-items-center">
                Users rated it
                <div class="ms-3">

                    @for ($i = 1; $i <= $product->averageRating(); $i++)
                        <i class="material-icons text-warning">star_rate</i>
                    @endfor

                </div>
            </div>
            <h2 class="mt-5">${{ number_format($product->price, 2) }}</h2>
            <div class="w-100 d-flex">
                <form action="{{ route('carts.addOne', ['product' => $product->id]) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center mt-4">
                        <i class="material-icons me-3">add_shopping_cart</i>
                        add to cart
                    </button>
                </form>
                <form action="{{ route('wishlists.store', ['product' => $product->id]) }}" method="POST"
                    class="d-inline">
                    @csrf
                    <button type="submit"
                        class="btn btn-primary d-flex align-items-center justify-content-center mt-4 ms-4">
                        <i class="material-icons me-3">add</i>
                        add to wishlist
                    </button>
                </form>
            </div>
        </div>
        <div class="row mt-4 mb-5">
            <h2 class="mt-4">Specifications / Description</h2>
            <hr class="mt-4">
            <p class="mt-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam corrupti et numquam sit facilis
                deserunt eius dolorum laudantium laborum doloremque eos minima expedita, quaerat unde? Similique, quis.
                Eveniet, labore aut?
                Minus nihil minima expedita, sunt nostrum nisi quo. Magnam eos nulla rem inventore porro voluptatum
                distinctio fugiat maxime beatae quaerat est optio, doloribus eaque similique vitae perferendis maiores
                ipsam fuga.
                Ratione, eius repellendus fuga molestiae consequatur quia mollitia architecto fugiat, libero placeat in
                perferendis ab, quam ipsam. Expedita provident obcaecati quos cumque ipsa aut neque libero tempore, eius
                doloremque saepe.
                Enim a odit sed eum, voluptatem, nihil quae, dolorum minus expedita quam quod! Nobis qui ullam dolorum?
                Consequatur nam omnis rem, voluptatem ex iste facilis deserunt excepturi provident dignissimos tempora!
                Iste quo repudiandae excepturi dolores fugiat omnis hic voluptatem pariatur voluptates animi nisi,
                eveniet obcaecati praesentium aspernatur sed vitae doloremque porro doloribus distinctio. Obcaecati,
                quos ab doloremque ipsam numquam quam.
            </p>
        </div>
        <div class="row mt-4 mb-5">
            <h2 class="mt-4">Reviews</h2>
            <hr class="mt-4">
            <div class="row-md-12 mt-4 mb-5 card p-4">
                <h2>Leave a review</h2>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="" disabled selected>Select rating</option>

                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor

                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 d-flex align-items-center">
                        <i class="material-icons me-3">send</i>
                        Submit my review
                    </button>
                </form>
            </div>
            <div class="mt-4">
                @if (!$reviews)
                    <div class="alert alert-warning">Nobody made a review yet. Buy the product so you can be the first!
                    </div>
                @else
                    @foreach ($reviews as $review)
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $review->user->first_name }} {{ $review->user->last_name }}
                                        </h5>
                                        <p class="mt-2">at {{$review->created_at->diffForHumans()}}</p>
                                        <div class="stars mt-2">
                                            @for ($i = 1; $i <= $review->rating; $i++)
                                                <i class="material-icons text-warning">star_rate</i>
                                            @endfor
                                        </div>
                                        <p class="card-text mt-2">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection