@extends('layout')

@section('title') Product Details @endsection

@section('content')

<div class="container">
    <h1 class="mt-5">PRODUCT | {{ $product->name }}</h1>
    <hr class="mt-4">
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
            <h2 class="mt-4">${{ number_format($product->price, 2) }}</h2>
            <a href="" class="btn btn-success d-flex align-items-center justify-content-center w-25 mt-4">
                <i class="material-icons me-3">add_shopping_cart</i>
                Add to cart
            </a>
        </div>
        <hr class="mt-4">
        <div class="row mt-4 mb-5">
            <h2 class="mt-4">Specifications</h2>
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
    </div>
</div>

@endsection