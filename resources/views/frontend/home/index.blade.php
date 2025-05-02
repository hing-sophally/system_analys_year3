@extends('frontend.layout')
<style>
    .carousel-item {
    height: 500px; /* Makes the carousel full screen height */
    background-size: cover; /* Ensures the image covers the full container */
    background-position: center;
}

.carousel-caption {
    bottom: 20%;
    text-align: center;
    color: white;
}
.carousel{
    border-radius: 16px; /* Adds rounded corners to the carousel */
    overflow: hidden; /* Ensures the rounded corners are applied to the images as well */
}

.carousel-control-prev-icon, .carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5); /* Adds a semi-transparent background to the controls */
}
@media (max-width: 768px) {
    .carousel-item-next, .carousel-item-prev, .carousel-item.active{
        height: auto;
    }
}
h1 {
    text-align: center; /* Centers the text */
    font-weight: 700 !important ;  /* Makes it bold */
}
.price {
    font-weight: bold; /* Makes the price bold */
    color: #28a745; /* Green color for the price */
    font-size: 1.2em; /* Increases the font size of the price */
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}


</style>
@section('content')
<div id="app">
    <div class="container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" style="margin-top: 40px;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://t4.ftcdn.net/jpg/02/62/24/31/240_F_262243135_q7xBjfg02gaeD1NVfIqHBLz3qrOMFYcw.jpg" class="d-block w-100" alt="First Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First Slide</h5>
                        <p>Some description for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://wallpapers.com/images/featured/fashion-model-pictures-u9ke1pkldg5pagfq.jpg" class="d-block w-100" alt="Second Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second Slide</h5>
                        <p>Some description for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://t3.ftcdn.net/jpg/03/03/61/68/360_F_303616856_4qQYfzu5kSuzCgQeSTKnH4lE6cpEiTYc.jpg" class="d-block w-100" alt="Third Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Some description for the third slide.</p>
                    </div>
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
        <div class="album bg-body-tertiary d-flex align-items-center justify-content-center" style="margin-top: 20px;">
            <div class="container">
                <h1 class="justify-content-center font-bold font-weight-bold">Our Category</h1>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
        
                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <img src="{{ '/storage/' . $category->image_url }}" 
                                     class="bd-placeholder-img card-img-top" 
                                     alt="{{ $category->name }}"
                                     style="width: 100%; height: auto; object-fit: contain;">
        
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text">{{ $category->description ?? 'No description available.' }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
        
                </div>
            </div>
        </div>
        <div class="album bg-body-tertiary d-flex align-items-center justify-content-center" style="margin-top: 20px;">
            <div class="container">
                <h1 class="justify-content-center font-bold font-weight-bold">Our Product</h1>
                <div class="album bg-light py-5">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                
                            @foreach ($products as $product)
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0">
                                        <img src="{{ '/storage/' . $product->image_url }}" 
                                             class="card-img-top p-3"
                                             alt="{{ $product->name }}"
                                             style="height: auto; object-fit: contain; background-color: #f9f9f9; border-radius: 0.5rem;">
                
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                            <p class="card-text text-muted small mb-3 line-clamp-2">
                                                {{ $product->description ?? 'No description available.' }}
                                            </p>
                                                                                    <p class="card-text mb-3">
                                                <strong>Stock:</strong> {{ $product->stock ?? 'N/A' }}
                                            </p>
                
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <span class="badge bg-primary fs-6 p-2">${{ number_format($product->price, 2) }}</span>
                                                <a href="#" class="btn btn-success btn-sm">Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
</div>
    @endsection