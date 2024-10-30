@extends('layout')

@section('title') Homepage @endsection

@section('content')

<div class="container">
    <div id="carouselExample" class="carousel slide mt-5">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/imgs/placeholder-image.jpg') }}" class="d-block w-100"
                    style="height: 400px; object-fit: cover;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/imgs/placeholder-image.jpg') }}" class="d-block w-100"
                    style="height: 400px; object-fit: cover;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/imgs/placeholder-image.jpg') }}" class="d-block w-100"
                    style="height: 400px; object-fit: cover;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h1 class="mt-5">Welcome! To the greatest e-commerce in the world.</h1>
    <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident mollitia modi quo quaerat
        cumque! Dolore quae
        magni aliquam culpa dolores laboriosam accusantium corrupti rem? Minima esse officiis assumenda beatae ex!
        Rem dicta voluptas cumque odio et debitis, nobis ratione asperiores repellendus earum consequuntur quod mollitia
        excepturi labore in magnam tempora nisi odit dolorum officiis veniam, ducimus ea adipisci. Quasi, ab?
    </p>

    <hr class="mt-5">

    <h3 class="mt-5">We have over {{ $categories->count() }} categories with thousands of products specially for you!
    </h3>
    <div class="mt-5">
        @foreach ($categories as $category)
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <div class="text-end">
                        <a href="{{ route('products.byCategoryId', ['id' => $category->id]) }}"
                            class="btn btn-primary d-flex justify-content-center">
                            <i class="material-icons me-2">add</i>
                            see more
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection