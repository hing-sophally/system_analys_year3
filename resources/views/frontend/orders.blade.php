@extends('frontend.layouts.app')

@section('title', 'My Orders - Ecommerce Store')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">My Orders</h1>
                <p class="lead">Track your order history</p>
            </div>
        </div>
    </div>
</section>

<!-- Orders Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No orders yet</h4>
                            <p class="text-muted">Your order history will appear here!</p>
                            <a href="{{ route('frontend.products') }}" class="btn btn-primary">Start Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
