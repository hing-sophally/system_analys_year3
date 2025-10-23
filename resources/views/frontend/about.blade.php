@extends('frontend.layouts.app')

@section('title', 'About Us - Ecommerce Store')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">About Us</h1>
                <p class="lead">Learn more about our company and mission</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Our Story</h2>
                <p class="lead">We started with a simple mission: to make quality products accessible to everyone.</p>
                <p>Founded in 2020, our ecommerce store has grown from a small startup to a trusted online destination for thousands of customers worldwide. We believe in providing exceptional value, outstanding customer service, and a seamless shopping experience.</p>
                <p>Our team is passionate about curating the best products and ensuring every customer has a positive experience from browsing to delivery.</p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Our Mission & Values</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-bullseye fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Our Mission</h5>
                    <p class="text-muted">To provide high-quality products at competitive prices while delivering exceptional customer service and building lasting relationships with our customers.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Our Values</h5>
                    <p class="text-muted">Integrity, quality, customer satisfaction, and innovation are the core values that drive everything we do at our company.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-eye fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Our Vision</h5>
                    <p class="text-muted">To become the leading ecommerce platform that customers trust and choose for all their shopping needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Meet Our Team</h2>
                <p class="text-muted">The passionate people behind our success</p>
            </div>
        </div>
        <div class="row">
            @for($i = 1; $i <= 4; $i++)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 text-center">
                    <img src="{{ asset('images/team-' . $i . '.jpg') }}" class="card-img-top rounded-circle mx-auto" alt="Team Member {{ $i }}" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Team Member {{ $i }}</h5>
                        <p class="text-muted">Position Title</p>
                        <div class="social-links">
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
