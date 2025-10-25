@extends('frontend.layouts.app')

@section('title', 'Products - Ecommerce Store')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Our Products</h1>
                <p class="lead">Discover our wide range of products</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="position-relative">
                        <div class="product-image-container" style="height: 250px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                            <img src="{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}" 
                                 class="card-img-top product-image" 
                                 alt="{{ $product->name }}" 
                                 style="height: 100%; width: 100%; object-fit: contain; transition: opacity 0.3s ease;"
                                 loading="lazy"
                                 onload="this.style.opacity='1'; this.parentElement.querySelector('.image-placeholder').style.display='none';"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.image-placeholder').style.display='flex';">
                            <div class="image-placeholder" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <div class="text-center">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">No Image</p>
                                </div>
                            </div>
                        </div>
                        <div class="product-badges position-absolute top-0 end-0 p-2">
                            @if($product->discount && $product->discount > 0)
                                <span class="badge bg-danger">
                                    <i class="fas fa-tag me-1"></i>{{ $product->discount }}% OFF
                                </span>
                            @endif
                        </div>
                        <div class="product-actions position-absolute top-50 start-50 translate-middle">
                            <button class="btn btn-light btn-sm me-2" title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                            @php
                                $finalPrice = $product->discount && $product->discount > 0 
                                    ? $product->price - ($product->price * $product->discount / 100)
                                    : $product->price;
                            @endphp
                            <button class="btn btn-light btn-sm me-2" title="Add to Wishlist" onclick="addToWishlist({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $finalPrice }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="btn btn-dark btn-sm" title="Add to Cart" onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $finalPrice }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($product->discount && $product->discount > 0)
                                        @php
                                            $discountedPrice = $product->price - ($product->price * $product->discount / 100);
                                        @endphp
                                        <div class="d-flex flex-column">
                                            <span class="text-muted text-decoration-line-through small">${{ number_format($product->price, 2) }}</span>
                                            <span class="h5 text-danger fw-bold mb-0">${{ number_format($discountedPrice, 2) }}</span>
                                        </div>
                                    @else
                                        <span class="h6 text-dark">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                            </div>
                            @if($product->stock <= 0)
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i>Out of Stock
                                </span>
                            @elseif($product->stock < 10)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Low Stock ({{ $product->stock }} units)
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>In Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products found</h4>
                <p class="text-muted">Check back later for new products!</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="row">
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.product-card {
    transition: transform 0.3s ease;
    border: none;
    width: 100%;
    min-height: 400px;
    display: flex;
    flex-direction: column;
}

.product-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* Simple Stock Status - Just disable buttons for out of stock */
.product-card .product-actions button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-actions {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
}

/* Smooth image loading */
.product-image {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-image.loaded {
    opacity: 1;
}

.product-image-container {
    position: relative;
    overflow: hidden;
}

.image-placeholder {
    transition: all 0.3s ease;
}

/* Loading animation */
.product-image-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: loading 1.5s infinite;
    z-index: 1;
}

@keyframes loading {
    0% { left: -100%; }
    100% { left: 100%; }
}

.product-image.loaded + .product-image-container::before {
    display: none;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Smooth image loading
    $('.product-image').each(function() {
        const img = $(this);
        const container = img.closest('.product-image-container');
        const placeholder = container.find('.image-placeholder');
        
        console.log('Processing image:', img.attr('src'));
        
        // Set initial opacity
        img.css('opacity', '0');
        
        // Handle image load
        img.on('load', function() {
            console.log('Image loaded successfully:', img.attr('src'));
            $(this).css('opacity', '1').addClass('loaded');
            placeholder.fadeOut(300);
        });
        
        // Handle image error
        img.on('error', function() {
            console.log('Image failed to load:', img.attr('src'));
            $(this).hide();
            placeholder.fadeIn(300);
        });
        
        // If image is already loaded (cached), show it immediately
        if (img[0].complete && img[0].naturalHeight !== 0) {
            console.log('Image already loaded (cached):', img.attr('src'));
            img.css('opacity', '1').addClass('loaded');
            placeholder.hide();
        }
    });
    
    // Add to cart functionality - now handled by onclick attributes
    // The onclick attributes will call the global addToCart function
    
    // Wishlist functionality - now handled by onclick attributes  
    // The onclick attributes will call the global addToWishlist function
    
    // Image hover effects
    $('.product-image-container').hover(
        function() {
            $(this).find('.product-image').css('transform', 'scale(1.05)');
        },
        function() {
            $(this).find('.product-image').css('transform', 'scale(1)');
        }
    );
});
</script>
@endpush
